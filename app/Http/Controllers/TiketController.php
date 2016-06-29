<?php

namespace App\Http\Controllers;

use App\BisBerangkat;
use App\BisDefault;
use App\Convert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\JenisBisTrayek;
use App\Pesanan;
use App\Trayek;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    public function index(Request $request)
    {
      if(Auth::check())
        {
          $Trayek = Trayek::all();

          foreach($Trayek as $trayek)
          {
            $array_trayek[] = $trayek;
            $trayek->jenis_bis_trayek;

            foreach($trayek->jenis_bis_trayek as $jenis_bis)
            {
              $jenis_bis->jenis_bis;
            }
          }

          $today = date('Y-m-d');
          $data['jml_tiket'] = DB::select(
          											"SELECT alias, COUNT(penumpang) as total 
                                  FROM trayek
                                  LEFT JOIN
                                    (SELECT trayek_id, penumpang
                                    FROM pesanan
                                    WHERE tanggal = '$today')
                                  AS jmlPenumpang
                                  ON trayek.id = jmlPenumpang.trayek_id
                                  GROUP BY alias
                                  ORDER BY id");

            // Cek Bis
            if(isset($request->bis_trayek) && isset($request->tanggal))
            {
              $jenis_bis_trayek_id = $request->bis_trayek;
              $tanggal = Convert::tgl_ind_to_eng($request->tanggal);

              $data_trayek = JenisBisTrayek::find($jenis_bis_trayek_id);
              $kode_trayek = $data_trayek->kode_trayek;

              // cek pada tanggal tersebut sudah ada di tetapkan bis yang berangkat belum
              $hitung_bis_berangkat = BisBerangkat::where('tanggal', '=', $tanggal)
                                                  ->where('kode_trayek', '=', $kode_trayek)
                                                  ->count();

              if($hitung_bis_berangkat == 0)
              {
                $bis_default = BisDefault::select(
                							'nomor_bis', 'kode_trayek', 'slug_jenis_bis', 'jumlah_kursi')
                                          ->where('kode_trayek', '=', $kode_trayek)
                                          ->distinct()
                                          ->get();
                  
                $data['Bis'] = $bis_default;
              }
              // Bis Berangkat
              else
              {
                $bis_berangkat = BisBerangkat::select(
                								'nomor_bis', 'kode_trayek', 'slug_jenis_bis', 
                								'jumlah_kursi', 'bis_id')
                                              ->where('kode_trayek', '=', $kode_trayek)
                                              ->where('tanggal', '=', $tanggal)
                                              ->distinct()
                                              ->get();

                $data['Bis'] = $bis_berangkat;
              }

                // status kursi
              $status = Pesanan::where('tanggal', '=', $tanggal)
                               ->where('kode_trayek', '=',  $kode_trayek)
                               ->get();

              foreach($status as $key => $kursi)
              {
                $data['kursi'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->status;
                $data['penumpang'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->penumpang;
                $data['telephone'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->telephone;
                $data['asal'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->domisili_asal;
                $data['tujuan'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->domisili_tujuan;
              }

              $data['tanggal'] = $tanggal;
              $data['data_trayek'] = $data_trayek;
              $data['jenis_bis_trayek_id'] = $jenis_bis_trayek_id;
            }
           
            $data['trayek'] = json_encode($array_trayek);
            $data['menu'] = 'pesan-tiket';

            return view('pesan-tiket', $data);
        }
        else
        {
            return view('layout.login');
        }
    }

    public function pesanTiket(Request $request)
    {
      $data = $request->all();
      unset($data['nomor_kursi']);

      $penumpang = $request->penumpang;
      $telephone = $request->telephone;
      $passport = $request->passport;
      $tanggal = $request->tanggal;
      $status = $request->status;
      $keterangan = $request->keterangan;
      $petugas_id = $request->petugas_id;
      $jenis_bis_trayek_id = $request->jenis_bis_trayek_id;
      $kode_trayek = $request->kode_trayek;
      $nomor_bis = $request->nomor_bis;
      $nomor_kursi = explode(',', $request->nomor_kursi);
      $bis_id = $request->bis_id;

      $hitung_pesanan = Pesanan::where('tanggal', '=', $tanggal)
                               ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                               ->where('kode_trayek', '=', $kode_trayek)
                               ->where('nomor_bis', '=', $nomor_bis)
                               ->whereIn('nomor_kursi', $nomor_kursi)
                               ->count();
        
      if($hitung_pesanan == 0)
      {
        foreach($nomor_kursi as $key => $kursi)
        {
          $data_pesanan[$key] = $data;
          $data_pesanan[$key]['nomor_kursi'] = $kursi; 
            
          Pesanan::create($data_pesanan[$key]);

          // Log
          DB::table('log_pesanan')->insert(array(
                    'petugas' => Auth::user()->petugas,
                    'aktivitas' => 'Booking tiket atas nama '.$penumpang.' dengan nomor kursi '.$kursi.' untuk tanggal '.\App\Convert::TanggalIndo($tanggal),
                    'jenis_bis_trayek_id' => $jenis_bis_trayek_id
          ));
        }
            
        $pesanan = Pesanan::where('tanggal', '=', $tanggal)
                          ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                          ->where('kode_trayek', '=', $kode_trayek)
                          ->where('nomor_bis', '=', $nomor_bis)
                          ->whereIn('nomor_kursi', $nomor_kursi)
                          ->get();
        // print_r($pesanan);

        // datalink
        $tanggal_link = \App\Convert::tgl_eng_to_ind($tanggal);
        $bis_trayek_link = $jenis_bis_trayek_id;

        return view('bayar-tiket')->with('pesanan', $pesanan)
                                  ->with('tanggal_link', $tanggal_link)
                                  ->with('bis_trayek_link', $bis_trayek_link)
                                  ->with('menu', 'pesan-tiket');
      }
      else
      {
        return back()->with('warning', 'Kursi '.$request->nomor_kursi.' 
        										sudah ada yang memesan')
                     ->withInput();
      }
    }

    public function bayarTiket(Request $request)
    {
      $pesanan_id = explode(',', $request->pesanan_id);
      $pesanan = Pesanan::find($pesanan_id[0]);
      $trayek_id = $pesanan->trayek_id;
      $alias_asal = strtoupper($pesanan->trayek->alias_asal);
      $alias_tujuan = strtoupper($pesanan->trayek->alias_tujuan);
      $tahun = date('Y');

      $default_numeratur = 'DMR000000'.'/'.$alias_asal.'/'.$alias_tujuan.'/'.$tahun;

      $hitung_cash = Pesanan::where('trayek_id', '=', $trayek_id)
                            ->whereYear('created_at', '=', $tahun)
                            ->where('status', '=', 'cash')
                            ->count();
        

      if($hitung_cash == 0)
      {
        $last_numeratur = $default_numeratur;
      }
      else
      {
        $last_numeratur = Pesanan::where('trayek_id', '=', $trayek_id)
                                 ->where('status', '=', 'cash')
                                 ->whereYear('created_at', '=', $tahun)
                                 ->orderBy('id', 'DESC')->first()->numeratur;
      }

      $numeratur = substr($last_numeratur, 0, 9);

      foreach($pesanan_id as $id)
      {
        $pesan = Pesanan::find($id);
        if($pesan->status == 'booking')
        {
          $numeratur++;
          $pesan->numeratur = $numeratur.'/'.$alias_asal.'/'.$alias_tujuan.'/'.$tahun;
          $pesan->status = 'cash';
          $pesan->save();

          $data[] = array('id' => $id, 'numeratur' => $numeratur.'/'.$alias_asal.'/'.$alias_tujuan.'/'.$tahun, 'status' => 'Lunas');
        }
        elseif($pesan->status == 'cash')
        {
          $data[] = array('id' => $id, 'numeratur' => $pesan->numeratur, 'status' => 'Lunas');
        }
      }

      return response()->json($data);
    }

    public function cetakTiket(Request $request)
    {
      $pesanan_id = $request->pesanan_id;

      $id = explode(',', $pesanan_id);
      $pesanan = Pesanan::whereIn('id', $id)->get();

      return view('cetak-tiket')->with('pesanan', $pesanan)
                                ->with('menu', 'pesan-tiket');
    }

    public function dataPesanan(Request $request)
    {

      $Trayek1 = DB::table('jenis_bis_trayek')
                  ->leftJoin('trayek', 'jenis_bis_trayek.trayek_id', '=', 'trayek.id')
                  ->leftJoin('jenis_bis', 'jenis_bis_trayek.jenis_bis_id', '=', 'jenis_bis.id')
                  ->whereIn('trayek.id',[1,2,8,9,10])
                  ->get();



      $Trayek2 = DB::table('jenis_bis_trayek')
                  ->select('alias', 'kode_trayek', 'jadwal', 'jenis')
                  ->leftJoin('trayek', 'jenis_bis_trayek.trayek_id', '=', 'trayek.id')
                  ->leftJoin('jenis_bis', 'jenis_bis_trayek.jenis_bis_id', '=', 'jenis_bis.id')
                  ->whereNotIn('trayek.id', [1,2,8,9,10])
                  ->distinct()
                  ->get();

        // Cek Pesanan
        if(isset($request->kode_trayek) && isset($request->tanggal))
        {
            $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
            
            $kode_trayek = $request->kode_trayek;
            $data_trayek = JenisBisTrayek::where('kode_trayek', '=', $kode_trayek)->first();

            $nomor_bis = Pesanan::select('nomor_bis')
            										->where('tanggal', '=', $tanggal)
                               	->where('kode_trayek', '=',  $kode_trayek)
                               	->distinct()
                               	->get();

            $hitungPnp = Pesanan::where('tanggal', '=', $tanggal)
                                ->where('kode_trayek', '=',  $kode_trayek)
                                ->count();


            if($hitungPnp > 0)
            {
              foreach($nomor_bis as $value)
              {
                $data['pesanan'] = 'pesanan';
                $pnpBooking[$value->nomor_bis] = Pesanan::where('tanggal', '=', $tanggal)
                                                      ->where('kode_trayek', '=',  $kode_trayek)
                                                      ->where('nomor_bis', '=', $value->nomor_bis)
                                                      ->where('status', '=', 'booking')
                                                      ->orderBy('nomor_kursi', 'ASC')
                                                      ->get();

                $pnpCash[$value->nomor_bis] = Pesanan::where('tanggal', '=', $tanggal)
                                                      ->where('kode_trayek', '=',  $kode_trayek)
                                                      ->where('nomor_bis', '=', $value->nomor_bis)
                                                      ->where('status', '=', 'cash')
                                                      ->orderBy('nomor_kursi', 'ASC')
                                                      ->get();

                $jmlHarga[$value->nomor_bis] = DB::table('pesanan')
                                                 ->leftJoin('jenis_bis_trayek', 'pesanan.jenis_bis_trayek_id', '=', 'jenis_bis_trayek.id')
                                                 ->where('pesanan.tanggal', '=', $tanggal)
                                                 ->where('pesanan.kode_trayek', '=',  $kode_trayek)
                                                 ->where('pesanan.nomor_bis', '=', $value->nomor_bis)
                                                 ->where('pesanan.status', '=', 'cash')
                                                 ->sum('harga');
              }
              // print_r($jmlHarga);
              $data['pnpBooking'] = $pnpBooking;
              $data['pnpCash'] = $pnpCash;
              $data['tanggal'] = $tanggal;
              $data['jmlHarga'] = $jmlHarga;
              $data['data_trayek'] = $data_trayek;
            }
        }

        $data['Trayek1'] = $Trayek1;
        $data['Trayek2'] = $Trayek2;
        $data['menu'] = 'data-pesanan';

        return view('data-pesanan', $data);
    }

    public function batalTiket(Request $request)
    {
        $pesanan_id = $request->pesanan_id;

        $id = explode(',', $pesanan_id);
        foreach($id as $value)
        {
            $pesan = Pesanan::find($value);
            $pesan->delete();
            
            // Log
            DB::table('log_pesanan')->insert(array(
                    'petugas' => Auth::user()->petugas,
                    'aktivitas' => 'Membatalkan tiket atas nama '.$pesan->penumpang.' dengan nomor kursi '.$pesan->kursi.' untuk tanggal '.\App\Convert::TanggalIndo($pesan->tanggal),
                    'jenis_bis_trayek_id' => $pesan->jenis_bis_trayek_id
                ));
        }

        return back();
    }

    public function pesananExport(Request $request)
    {
    	$tanggal = $request->tanggal;
    	$kode_trayek = $request->kode_trayek;
      $data_trayek = JenisBisTrayek::where('kode_trayek', '=', $kode_trayek)->first();

      $nomor_bis = Pesanan::select('nomor_bis')
                          ->where('tanggal', '=', $tanggal)
                          ->where('kode_trayek', '=',  $kode_trayek)
                          ->distinct()
                          ->get();

      $cek_seri = DB::table('document_ap3')
                          ->where('tanggal', '=', $tanggal)
                          ->where('kode_trayek', '=', $kode_trayek)
                          ->count();

      $last_seri = DB::table('document_ap3')->orderBy('id', 'DESC')->first()->seri;

      foreach($nomor_bis as $value)
      {
        $data['pesanan'] = 'pesanan';
        $pnpCash[$value->nomor_bis] = Pesanan::where('tanggal', '=', $tanggal)
                                              ->where('kode_trayek', '=',  $kode_trayek)
                                              ->where('nomor_bis', '=', $value->nomor_bis)
                                              ->where('status', '=', 'cash')
                                              ->orderBy('nomor_kursi', 'ASC')
                                              ->get();

        $jmlHarga[$value->nomor_bis] = DB::table('pesanan')
                                         ->leftJoin('jenis_bis_trayek', 'pesanan.jenis_bis_trayek_id', '=', 'jenis_bis_trayek.id')
                                         ->where('pesanan.tanggal', '=', $tanggal)
                                         ->where('pesanan.kode_trayek', '=',  $kode_trayek)
                                         ->where('pesanan.nomor_bis', '=', $value->nomor_bis)
                                         ->where('pesanan.status', '=', 'cash')
                                         ->sum('harga');

        $jmlPnp[$value->nomor_bis] = DB::table('pesanan')
                                        ->where('tanggal', '=', $tanggal)
                                        ->where('kode_trayek', '=',  $kode_trayek)
                                        ->where('nomor_bis', '=', $value->nomor_bis)
                                        ->where('status', '=', 'cash')
                                        ->count();

        if($cek_seri == 0)
        {
          $last_seri++;
          DB::table('document_ap3')->insert(array(
              'kode_trayek' => $kode_trayek,
              'tanggal' => $tanggal,
              'nomor_bis' => $value->nomor_bis,
              'seri' => $last_seri
          ));
          $seri[$value->nomor_bis] = $last_seri;
        }
        else
        {
          $seri[$value->nomor_bis] = DB::table('document_ap3')
                                        ->where('tanggal', '=', $tanggal)
                                        ->where('kode_trayek', '=', $kode_trayek)
                                        ->where('nomor_bis', '=', $value->nomor_bis)
                                        ->first()->seri;
        }
      }
      
      $data['pnpCash'] = $pnpCash;
      $data['jmlPnp'] = $jmlPnp;
      $data['tanggal'] = $tanggal;
      $data['jmlHarga'] = $jmlHarga;
      $data['data_trayek'] = $data_trayek;
      $data['seri'] = $seri;

    	$pdf = \App::make('dompdf.wrapper');
			$pdf->loadView('pdf.laporan-penumpang', $data);
			return $pdf->stream();
    }
}
