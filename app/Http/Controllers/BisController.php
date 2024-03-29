<?php

namespace App\Http\Controllers;

use App\Bis;
use App\BisBerangkat;
use App\BisDefault;
use App\Convert;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\JenisBis;
use App\JenisBisTrayek;
use App\Pesanan;
use App\Trayek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BisController extends Controller
{

    public function bisDefault()
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
    	$data['trayek'] = json_encode($array_trayek);
    	$data['bis_default'] = DB::select("SELECT DISTINCT 
                                            alias,nomor_bis, jadwal, 
                                            slug_jenis_bis, jumlah_kursi, bis_default.kode_trayek
                                          FROM bis_default
                                          LEFT JOIN jenis_bis_trayek
                                          ON bis_default.jenis_bis_trayek_id = jenis_bis_trayek.id
                                          LEFT JOIN trayek ON jenis_bis_trayek.trayek_id = trayek.id");

        $data['menu'] = 'unit-bis';
    	return view('bis-default', $data);
    }

    public function insertBisDefault(Request $request)
    {
    	$data = $request->all();
    	unset($data['bis_trayek']);
    	$data_bis = JenisBisTrayek::find($request->bis_trayek);
        $data['kode_trayek'] = $data_bis->kode_trayek;
        $data['slug_jenis_bis'] = $data_bis->jenis_bis->slug_jenis;
    	$data['jenis_bis_trayek_id'] = $request->bis_trayek;
    	$hitungBis = BisDefault::where('jenis_bis_trayek_id','=',$request->bis_trayek)
	    						->where('nomor_bis','=',$request->nomor_bis)
	    						->count();

    	// print_r($data);
    	if($hitungBis == 0)
    	{
            // print_r($data);
    		BisDefault::create($data);
    		return back();
    	}
    	else
    	{
    		return back()->with('warning', 'Bis Sudah di tetapkan sebelumnya');
    	}
    }

    public function updateBisDefault(Request $request)
    {
        $kode_trayek = $request->kode_trayek;
        $nomor_bis = $request->nomor_bis;
        $jumlah_kursi = $request->jumlah_kursi;

        BisDefault::where('kode_trayek', '=', $kode_trayek)
                  ->where('nomor_bis', '=', $nomor_bis)
                  ->update(array(
                    'jumlah_kursi' => $jumlah_kursi
                ));

        return back();
    }

    public function bisBerangkat()
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
        $data['bis'] = Bis::all();
    	$data['trayek'] = json_encode($array_trayek);
    	$data['bis_berangkat'] = BisBerangkat::select('bis_berangkat.kode_trayek','alias', 'slug_jenis_bis', 'tanggal', 'jumlah_kursi', 'bis_id', 'jadwal', 'nomor_bis')
                                            ->leftJoin('jenis_bis_trayek', 'jenis_bis_trayek.id', '=', 'bis_berangkat.jenis_bis_trayek_id')
                                            ->leftJoin('trayek', 'trayek.id', '=', 'jenis_bis_trayek.trayek_id')
                                            ->whereDate('tanggal', '>=', date('Y-m-d'))
                                             ->orderBy('tanggal', 'ASC')
                                             ->orderBy('jenis_bis_trayek_id', 'ASC')
                                             ->orderBy('nomor_bis', 'ASC')
                                             ->distinct()
    										 ->get();

        $data['menu'] = 'unit-bis';

    	return view('bis-berangkat', $data);
    }

    public function insertBisBerangkat(Request $request)
    {
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
        
        $bis_default = BisDefault::all();

        foreach ($bis_default as $key => $value) 
        {
            $hitung_bis_berangkat = BisBerangkat::where('jenis_bis_trayek_id', '=', $value->jenis_bis_trayek_id)
                                                ->where('kode_trayek', '=', $value->kode_trayek)
                                                ->where('nomor_bis', '=', $value->nomor_bis)
                                                ->where('tanggal', '=', $tanggal)
                                                ->count();

            if($hitung_bis_berangkat == 0)
            {
                BisBerangkat::create(array(
                    'jenis_bis_trayek_id' => $value->jenis_bis_trayek_id,
                    'kode_trayek' => $value->kode_trayek,
                    'nomor_bis' => $value->nomor_bis,
                    'tanggal' => $tanggal,
                    'slug_jenis_bis' => $value->slug_jenis_bis,
                    'jumlah_kursi' => $value->jumlah_kursi
                ));
            }
            else
            {
                return back()->with('warning', 'Maaf, Bis pada jadwal trayek ini sudah di tetapkan');
            }
        }

        return back();
    }

    public function insertBisTambahan(Request $request)
    {
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
        $nomor_bis = $request->nomor_bis;
        $bis_trayek = $request->bis_trayek;

        // $bis_trayek;

        foreach($bis_trayek as $key => $jenis_bis_trayek_id)
        {
            $cek = BisBerangkat::where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                            ->where('nomor_bis', '=', $nomor_bis)
                            ->where('tanggal', '=', $tanggal)
                            ->count();

            $kode_trayek = JenisBisTrayek::find($jenis_bis_trayek_id)->kode_trayek;
            if($kode_trayek == 'RYL-FRGN-PTK-07-KCH')
            {
                $slug_jenis_bis = 'royal-foreign';
                $jumlah_kursi = '22';
            }
            else
            {
                $bis_default = BisDefault::where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)->first();
                $slug_jenis_bis = $bis_default->slug_jenis_bis;
                $jumlah_kursi = $bis_default->jumlah_kursi;
            }
            
            // echo $cek;
            if($cek == 0)
            {
                BisBerangkat::create(array(
                    'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                    'nomor_bis' => $nomor_bis,
                    'kode_trayek' => $kode_trayek,
                    'tanggal' => $tanggal,
                    'slug_jenis_bis' => $slug_jenis_bis,
                    'jumlah_kursi' => $jumlah_kursi
                )); 
            }
            else
            {
                return back()->with('warning', 'Maaf, Bis pada jadwal trayek ini sudah di tetapkan');
            }
        }
        return back();
    }

    public function updateBisBerangkat(Request $request)
    {
        $kode_trayek = $request->kode_trayek;
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
        $nomor_bis = $request->nomor_bis;
        $nomor_bis_old = $request->nomor_bis_old;
        $bis_id = $request->bis_id;
        
        BisBerangkat::where('kode_trayek', '=', $kode_trayek)
                    ->where('tanggal', '=', $tanggal)
                    ->where('nomor_bis', '=', $nomor_bis_old)
                    ->update(array(
                        'bis_id' => $bis_id,
                        'nomor_bis' => $nomor_bis
                    ));

        Pesanan::where('kode_trayek', '=', $kode_trayek)
                    ->where('tanggal', '=', $tanggal)
                    ->where('nomor_bis', '=', $nomor_bis_old)
                    ->update(array(
                        'bis_id' => $bis_id,
                        'nomor_bis' => $nomor_bis
                    ));

        return back();
    }

    public function deleteBisBerangkat(Request $request)
    {
        $kode_trayek = $request->kode_trayek;
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
        $nomor_bis = $request->nomor_bis;

        BisBerangkat::where('kode_trayek', '=', $kode_trayek)
                    ->where('tanggal', '=', $tanggal)
                    ->where('nomor_bis', '=', $nomor_bis)
                    ->delete();

        return back();
    }

    public function dataBis()
    {
    	$data['bis'] = Bis::orderBy('jenis_bis_id', 'ASC')->get();
    	$data['jenisBis'] = JenisBis::all();
        $data['menu'] = 'unit-bis';
    	return view('data-bis', $data);
    }

    public function insertDataBis(Request $request)
    {
    	$data = $request->all();

    	Bis::create($data);

    	return back();
    }

    public function deleteDataBis($id)
    {
        // delete di bis
        Bis::find($id)->delete();
        // delete juga di bis berangkat
        BisBerangkat::where('bis_id', '=', $id)->update(array('bis_id' => 0));
        // update pesanan di bis id = id menjadi 0
        Pesanan::where('bis_id', '=', $id)->update(array('bis_id' => 0));

        return back();
    }

    public function layoutBis()
    {
        return view('layout.kursi-executive-31');
    }

}
