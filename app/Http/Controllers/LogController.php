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
}
