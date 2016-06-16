<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LogPesanan;
use Illuminate\Http\Request;
use Datatables;

class LogController extends Controller
{
    public function logPesanan()
    {
    	$data['menu'] = 'log';
    	return view('log-pesanan', $data);
    }

    public function logPesananData()
    {
    	$log = LogPesanan::with('jenis_bis_trayek.jenis_bis');
    	return Datatables::of($log)->make(true);
    }
}
