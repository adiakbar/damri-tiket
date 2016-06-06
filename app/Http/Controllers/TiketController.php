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

class TiketController extends Controller
{
    public function index(Request $request)
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
                $data['bis'] = $bis_default;
            }
            else
            {
                $bis_berangkat = BisBerangkat::where('tanggal', '=', $tanggal)
                                             ->where('kode_trayek', '=', $kode_trayek)
                                             ->get();
                $data['bis'] = $bis_berangkat;
            }

            // $bis_default[0]->jenis_bis_trayek->jenis_bis->slug_jenis;

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

    	return view('pesan-tiket', $data);
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
            }
            
            $pesanan = Pesanan::where('tanggal', '=', $tanggal)
                              ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                              ->where('kode_trayek', '=', $kode_trayek)
                              ->where('nomor_bis', '=', $nomor_bis)
                              ->whereIn('nomor_kursi', $nomor_kursi)
                              ->get();
            // print_r($pesanan);
            return view('bayar-tiket')->with('pesanan', $pesanan);
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
        return view('cetak-tiket')->with('pesanan', $pesanan);
    }
}
