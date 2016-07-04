<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LogPesanan;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function logPesanan()
    {
    	$data['menu'] = 'log';
    	return view('log-pesanan', $data);
    }

    public function logPesananData()
    {
    	// $log = ::with('jenis_bis_trayek.jenis_bis');
    	
        $log = LogPesanan::select('petugas', 'aktivitas', 'log_pesanan.created_at', 'jadwal', 'stasiun_asal', 'stasiun_tujuan','jenis')
                ->leftJoin('jenis_bis_trayek', 'jenis_bis_trayek.id', '=', 'log_pesanan.jenis_bis_trayek_id')
                ->leftJoin('jenis_bis', 'jenis_bis.id', '=', 'jenis_bis_trayek.jenis_bis_id')
                ->latest()
                ->get();
        return Datatables::of($log)->make(true);
    }
}
