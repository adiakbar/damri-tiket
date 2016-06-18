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
    	$data['bis_default'] = BisDefault::orderBy('jenis_bis_trayek_id', 'ASC')->get();
        $data['menu'] = 'unit-bis';
    	return view('bis-default', $data);
    }

    public function insertBisDefault(Request $request)
    {
    	$data = $request->all();
    	unset($data['bis_trayek']);
    	$data['kode_trayek'] = JenisBisTrayek::find($request->bis_trayek)->kode_trayek;
    	$data['jenis_bis_trayek_id'] = $request->bis_trayek;
    	$hitungBis = BisDefault::where('jenis_bis_trayek_id','=',$request->bis_trayek)
	    						->where('nomor_bis','=',$request->nomor_bis)
	    						->count();

    	// print_r($data);
    	if($hitungBis == 0)
    	{
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
        $id = $request->id;
        $nomor_bis = $request->nomor_bis;
        $jumlah_kursi = $request->jumlah_kursi;

        $bis = BisDefault::find($id);
        $bis->nomor_bis = $nomor_bis;
        $bis->jumlah_kursi = $jumlah_kursi;
        $bis->save();

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
    	$data['bis_berangkat'] = BisBerangkat::whereDate('tanggal', '>=', date('Y-m-d'))
    										 
                                             ->orderBy('tanggal', 'ASC')
                                             ->orderBy('jenis_bis_trayek_id', 'ASC')
                                             ->orderBy('nomor_bis', 'ASC')
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
            $bis_default = BisDefault::where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)->first();
            // echo $cek;
            if($cek == 0)
            {
                BisBerangkat::create(array(
                    'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                    'nomor_bis' => $nomor_bis,
                    'kode_trayek' => $kode_trayek,
                    'tanggal' => $tanggal,
                    'slug_jenis_bis' => $bis_default->slug_jenis_bis,
                    'jumlah_kursi' => $bis_default->jumlah_kursi
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
        $id = $request->id;
        $bis_id = $request->bis_id;

        $bis = BisBerangkat::find($id);
        $bis->bis_id = $bis_id;
        $bis->save();

        return back();
    }

    public function deleteBisBerangkat($id)
    {
        $bis = BisBerangkat::find($id);
        $bis->delete();

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
        BisBerangkat::where('bis_id', '=', $id)->delete();
        // update pesanan di bis id = id menjadi 0
        Pesanan::where('bis_id', '=', $id)->update(array('bis_id' => 0));

        return back();
    }

    public function layoutBis()
    {
        return view('layout.kursi-executive-31');
    }

}
