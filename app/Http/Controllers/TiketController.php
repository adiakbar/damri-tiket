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
            $data['jml_tiket'] = DB::select("SELECT alias, COUNT(penumpang) as total 
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
                    $bis_default = BisDefault::where('kode_trayek', '=', $kode_trayek)->get();
                    


                    die();
                }
                // Bis Berangkat
                else
                {
                    $bis_berangkat = BisBerangkat::where('tanggal', '=', $tanggal)
                                                 ->where('kode_trayek', '=', $kode_trayek)
                                                 ->get();

                    foreach($bis_berangkat as $key => $value)
                    {
                        $nomor_bis[] = $value->nomor_bis;
                    }

                    // jika beda stasiun beda bis
                    if(in_array(1, array_count_values($nomor_bis)))
                    {
                        $data['bis'] = ['ini array 1', 'ini array 2']; // untuk ngakalkan perhitungan array
                        $data['Bis'] = BisBerangkat::select('nomor_bis','bis_id')
                                                 ->where('kode_trayek', '=', $kode_trayek)
                                                 ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                                                 ->where('tanggal', '=', $tanggal)
                                                 ->distinct()
                                                 ->get();
                    }
                    else
                    {
                        $data['bis'] = ['ini array 1', 'ini array 2']; // untuk ngakalkan perhitungan array
                        $data['Bis'] = BisBerangkat::select('nomor_bis','bis_id')
                                                    ->where('kode_trayek', '=', $kode_trayek)
                                                    ->where('tanggal', '=', $tanggal)
                                                    ->distinct()
                                                    ->get();
                    
                    }
                }

                // status kursi
                $status = Pesanan::where('tanggal', '=', $tanggal)
                                 ->where('kode_trayek', '=',  $kode_trayek)
                                 ->get();

                foreach($status as $key => $kursi)
                {
                    $data['kursi'][$kursi->nomor_bis][$kursi->nomor_kursi] = $kursi->status;
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
            return view('bayar-tiket')->with('pesanan', $pesanan)
                                      ->with('menu', 'pesan-tiket');
        }
        else
        {
            return back()->with('warning', 'Kursi '.$request->nomor_kursi.' sudah ada yang memesan')
                             ->withInput();
        }
    }

    public function bayarTiket(Request $request)
    {
        $pesanan_id = $request->pesanan_id;

        $id = explode(',', $pesanan_id);
        $numeratur = 'DMR000000';

        foreach($id as $value)
        {
            $jmlKar = strlen($value);
            $cutNumeratur = substr($numeratur, '0', -$jmlKar);
            $newNumeratur = $cutNumeratur.''.$value;

            $pesan = Pesanan::find($value);
            $pesan->numeratur = $newNumeratur;
            $pesan->status = 'cash';
            $pesan->save();

            DB::table('log_pesanan')->insert(array(
                    'petugas' => Auth::user()->petugas,
                    'aktivitas' => 'Menerima pembayaran tiket atas nama '.$pesan->penumpang.' dengan nomor kursi '.$pesan->nomor_kursi.' untuk tanggal '.\App\Convert::TanggalIndo($pesan->tanggal),
                    'jenis_bis_trayek_id' => $pesan->jenis_bis_trayek_id
                ));

            $data[] = array('id' => $value, 'numeratur' => $newNumeratur, 'status' => 'Lunas');
        }
        return response()->json($data);
    }

    public function cetakTiket(Request $request)
    {
        $pesanan_id = $request->pesanan_id;

        $id = explode(',', $pesanan_id);
        $pesanan = Pesanan::whereIn('id', $id)->get();

        // return "helo";
        return view('cetak-tiket')->with('pesanan', $pesanan)
                                  ->with('menu', 'pesan-tiket');
    }

    public function dataPesanan(Request $request)
    {
        $Trayek = Trayek::all();

        // Cek Pesanan
        if(isset($request->trayek_id) && isset($request->tanggal))
        {
            $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
            $pesanan = Pesanan::where('tanggal', '=', $tanggal)
                              ->where('trayek_id', '=', $request->trayek_id)
                              ->orderBy('jenis_bis_trayek_id', 'ASC')
                              ->orderBy('nomor_kursi', 'ASC')
                              ->get();

            $data['pesanan'] = $pesanan;
            $data['trayek'] = Trayek::find($request->trayek_id);
            $data['tanggal'] = $tanggal;
        }

        $data['Trayek'] = $Trayek;
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
        // print_r($data);
    }
}
