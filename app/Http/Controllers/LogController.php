<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use App\LogPesanan;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function logPesanan(Request $request)
    {
    	$data['menu'] = 'log';
        $data['log'] = LogPesanan::latest()->limit(2000)->get();
        $data['Petugas'] = DB::table('petugas')
                            ->where('id', '!=', 1)
                            ->lists('petugas');
        $data['petugas'] = '';
        $data['tanggal'] = '';

        if($request->petugas != '' AND $request->tanggal == '')
        {
            // log si petugas terbaru jak
            $data['log'] = LogPesanan::where('petugas', $request->petugas)
                                    ->latest()->limit(2000)->get();

            $data['petugas'] = $request->petugas;
            $data['tanggal'] = $request->tanggal;
        }
        else if($request->petugas == '' AND $request->tanggal != '')
        {
            $tanggal = \App\Convert::tgl_ind_to_eng($request->tanggal);
            // log semua petugas dari rentang tanggal
            $data['log'] = LogPesanan::where('tanggal', $tanggal)->latest()->limit(2000)->get();

            $data['petugas'] = $request->petugas;
            $data['tanggal'] = $request->tanggal;
        }
        else if($request->petugas != '' AND $request->tanggal != '')
        {
            $tanggal = \App\Convert::tgl_ind_to_eng($request->tanggal);

            // log semua petugas dari rentang tanggal
            $data['log'] = LogPesanan::where('petugas', $request->petugas)
                                    ->where('tanggal', $tanggal)->latest()->limit(2000)->get();

            $data['petugas'] = $request->petugas;
            $data['tanggal'] = $request->tanggal;
        }

    	return view('log-pesanan', $data);
    }

    public function logPesananData()
    {
    	// $log = ::with('jenis_bis_trayek.jenis_bis');
    	
        // $log = LogPesanan::select('petugas', 'aktivitas', 'log_pesanan.created_at', 'jadwal', 'stasiun_asal', 'stasiun_tujuan','jenis')
        //         ->leftJoin('jenis_bis_trayek', 'jenis_bis_trayek.id', '=', 'log_pesanan.jenis_bis_trayek_id')
        //         ->leftJoin('jenis_bis', 'jenis_bis.id', '=', 'jenis_bis_trayek.jenis_bis_id')
        //         ->latest()
        //         ->get();
        // return Datatables::of($log)->make(true);
    }

    public function logPetugas(Request $request)
    {
        $data['menu'] = 'log';

        $tanggal = date('Y-m-d');

        if(isset($request->tanggal) AND $request->tanggal != '')
        {
            $tanggalConvert = \App\Convert::tgl_ind_to_eng($request->tanggal);
            $tanggal = $tanggalConvert;
        }

        $data['tanggal'] = \App\Convert::tgl_eng_to_ind($tanggal);  
        $data['jml_tiket'] = DB::select(
                                "SELECT petugas.id, petugas, COUNT(penumpang) as total, SUM(harga) as jumlah
                                 FROM petugas
                                 LEFT JOIN
                                    (SELECT petugas_id, penumpang, jenis_bis_trayek_id
                                     FROM pesanan
                                     WHERE tanggal = '$tanggal'
                                     AND status = 'cash')
                                 AS jmlPenumpang
                                 ON petugas.id = jmlPenumpang.petugas_id
                                 LEFT JOIN jenis_bis_trayek
                                 ON jmlPenumpang.jenis_bis_trayek_id = jenis_bis_trayek.id
                                 WHERE petugas.id != 1
                                 GROUP BY petugas                   
                                 ORDER BY petugas.id");

        
        return view('log.log-petugas', $data);
    }

    public function logPetugasDetail(Request $request, $id)
    {
        $data['menu'] = 'log';

        $tanggal = date('Y-m-d');

        if(isset($request->tanggal) AND $request->tanggal != '')
        {
            $tanggalConvert = \App\Convert::tgl_ind_to_eng($request->tanggal);
            $tanggal = $tanggalConvert;
        }

        $data['tanggal'] = \App\Convert::tgl_eng_to_ind($tanggal);
        $data['detail'] = \App\Pesanan::where('petugas_id', $id)
                                        ->where('tanggal', $tanggal)
                                        ->where('status', 'cash')
                                        ->get();
        $data['jumlah'] = DB::select("SELECT count(penumpang) as total, sum(harga) as jumlah
                                        FROM pesanan
                                        
                                     LEFT JOIN jenis_bis_trayek
                                     ON pesanan.jenis_bis_trayek_id = jenis_bis_trayek.id
                                     WHERE tanggal = '$tanggal'
                                     AND status = 'cash'
                                     AND petugas_id = '$id'");

        $data['profil'] = \App\User::find($id);

        return view('log.log-petugas-detail', $data);
    }
}
