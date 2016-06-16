<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\JenisBis;
use App\JenisBisTrayek;
use App\Trayek;
use Illuminate\Http\Request;

class TrayekController extends Controller
{
    public function index(Request $request)
    {
    	$trayek = Trayek::all();

    	$data['Trayek'] = $trayek;

    	if($request->trayek_id)
    	{
    		$trayek_id = $request->trayek_id;
    		$data['trayek'] = Trayek::find($trayek_id);
    		$data['BisTrayek'] = JenisBisTrayek::where('trayek_id', '=', $trayek_id)->get();
    		$data['jenisBis'] = JenisBis::all();
    	}

        $data['menu'] = 'trayek';
    	return view('trayek', $data);
    }

    public function insertDetailTrayek(Request $request)
    {
    	$trayek = Trayek::find($request->trayek_id);
    	$jenisBis = JenisBis::find($request->jenis_bis_id);

    	$a = $jenisBis->alias;
    	$b = strtoupper($trayek->alias_asal);
    	$c = substr($request->jadwal, 0, 2);
    	$d = strtoupper($trayek->alias_tujuan);

    	$kode_trayek = $a.'-'.$b.'-'.$c.'-'.$d;

    	$data = $request->all();
    	$data['kode_trayek'] = $kode_trayek;
    	
    	JenisBisTrayek::create($data);

    	return back();

    }

    public function insertTrayek(Request $request)
    {
        $data = $request->all();

        $data['alias'] = $request->asal.' - '.$request->tujuan;
        $data['slug_alias'] = \App\Convert::make_slug($data['alias']);

        Trayek::create($data);

        return back();
    }

    public function deleteTrayek($id)
    {
        // $trayek = Trayek::find($id);
        // $trayek->delete();
        return back();
    }

    public function deleteDetailTrayek($id)
    {
        // $trayek = JenisBisTrayek::find($id);
        // $trayek->delete();
        return back();
    }
}
