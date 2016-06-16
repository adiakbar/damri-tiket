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
    										 ->orderBy('jenis_bis_trayek_id', 'ASC')
    										 ->get();
        $data['menu'] = 'unit-bis';

    	return view('bis-berangkat', $data);
    }

    public function insertBisBerangkat(Request $request)
    {
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);
        $kode_trayek = DB::table('jenis_bis_trayek')->whereIn('id',$request->bis_trayek)->first()->kode_trayek;
        $bis_trayek = $request->bis_trayek;
        $nomor_bis = $request->nomor_bis;
        $bis_id = $request->bis_id;
        
        foreach($bis_trayek as $key => $jenis_bis_trayek_id)
        {
            // Cek apakah tanggal dan jenis_bis_trayek_id sudah ada di DB bis berangkat
            $cek1 = DB::table('bis_berangkat')
                        ->where('tanggal', '=', $tanggal)
                        ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)->count();
            // Jika belum ada
            if($cek1 == 0)
            {
                // Ini adalah bis utama (syarat utama nomor_bis harus sama dengan bis default)
                // Cek apakah nomor bis inputan sama dengan nomor bis default
                $nomor_bis_default = DB::table('bis_default')->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)->first()->nomor_bis;
                // jika sama
                if($nomor_bis_default == $nomor_bis)
                {
                    // Cek apakah tanggal dan bis_id sudah di gunakan di DB bis berangkat
                    $cek2 = DB::table('bis_berangkat')
                            ->where('tanggal', '=', $tanggal)->where('bis_id', '=', $bis_id)->count();
                    // Jika belum
                    if($cek2 == 0)
                    {
                        // Create BisBerangkat pada kondisi bis_id belum digunakan
                        BisBerangkat::create(array(
                            'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                            'kode_trayek' => $kode_trayek,
                            'nomor_bis' => $nomor_bis,
                            'bis_id' => $bis_id,
                            'tanggal' => $tanggal
                        ));
                        // // Update bis_id untuk table Pesanan
                        Pesanan::where('tanggal', '=', $tanggal)
                               ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                               ->where('nomor_bis', '=', $nomor_bis)
                               ->update(array('bis_id' => $bis_id));
                        
                        return back();
                    }
                    // Jika sudah
                    else
                    {
                        // Cek kode_trayek dan nomor bis yang digunakan sama ndak dengan inputan
                        $cek3 = DB::table('bis_berangkat')
                                  ->where('tanggal', '=', $tanggal)->where('bis_id', '=', $bis_id)->first();
                        // Jika sama
                        if($cek3->kode_trayek == $kode_trayek && $cek3->nomor_bis == $nomor_bis)
                        {
                            // Create BisBerangkat pada kondisi bis_id sudah digunakan
                            BisBerangkat::create(array(
                                'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                                'kode_trayek' => $kode_trayek,
                                'nomor_bis' => $nomor_bis,
                                'bis_id' => $bis_id,
                                'tanggal' => $tanggal
                            ));
                            // // Update bis_id untuk table Pesanan
                            Pesanan::where('tanggal', '=', $tanggal)
                                   ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                                   ->where('nomor_bis', '=', $nomor_bis)
                                   ->update(array('bis_id' => $bis_id));

                            return back();
                        } 
                        // jika tidak sama
                        else
                        {
                            return back()->with('warning', 'Maaf, Trayek dan Plat Bis tidak sama dengan bis sebelumnya');
                        }
                    }
                }
                // jika tidak sama
                else
                {
                    return back()->with('warning', 'Maaf, Nomor Bis beda dengan Nomor Bis Default');
                }
            }
            // jika ada
            else
            {
                // Ini adalah bis tambahan
                // Cek apakah jenis_bis_trayek_id, tanggal, bis_id dan nomor_bis sudah ada
                $cek4 = DB::table('bis_berangkat')
                          ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                          ->where('tanggal', '=', $tanggal)
                          ->where('bis_id', '=', $bis_id)
                          ->where('nomor_bis', '=', $nomor_bis)
                          ->count();
                // Jika belum ada
                if($cek4 == 0)
                {
                    // Cek apakah jenis_bis_trayek_id, tanggal dan nomor_bis sudah ada
                    $cek5 = DB::table('bis_berangkat')
                          ->where('jenis_bis_trayek_id', '=', $jenis_bis_trayek_id)
                          ->where('tanggal', '=', $tanggal)
                          ->where('nomor_bis', '=', $nomor_bis)
                          ->count();
                    // jika belum ada
                    if($cek5 == 0)
                    {
                        // Cek apakah tanggal dan bis_id sudah ada
                        $cek6 = DB::table('bis_berangkat')
                                  ->where('tanggal', '=', $tanggal)
                                  ->where('bis_id', '=', $bis_id)
                                  ->count();
                        // Jika tidak ada
                        if($cek6 == 0)
                        {
                            // Cek apakah nomor_bis sudah digunakan di kode_trayek pada bis default
                            $cek7 = DB::table('bis_default')
                                      ->where('nomor_bis', '=', $nomor_bis)
                                      ->where('kode_trayek', '=', $kode_trayek)
                                      ->count();
                            // jika belum
                            if($cek7 == 0)
                            {
                                // Create BisBerangkat tambahan pada kondisi bis_id belum digunakan
                                BisBerangkat::create(array(
                                    'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                                    'kode_trayek' => $kode_trayek,
                                    'nomor_bis' => $nomor_bis,
                                    'bis_id' => $bis_id,
                                    'tanggal' => $tanggal
                                ));

                                return back();
                            }
                            // jika sudah
                            else
                            {   
                                return back()->with('warning', 'Maaf, Nomor Bis sudah digunakan pada trayek lain di Bis Default');
                            }
                        }
                        else
                        {
                            // Cek kode_trayek dan nomor bis yang digunakan sama ndak dengan inputan
                            $cek8 = DB::table('bis_berangkat')
                                      ->where('tanggal', '=', $tanggal)->where('bis_id', '=', $bis_id)->first();
                            // Jika sama
                            if($cek8->kode_trayek == $kode_trayek && $cek8->nomor_bis == $nomor_bis)
                            {
                                // Create BisBerangkat tambahan pada kondisi bis_id sudah digunakan dengan syarat kode_trayek sama
                                BisBerangkat::create(array(
                                    'jenis_bis_trayek_id' => $jenis_bis_trayek_id,
                                    'kode_trayek' => $kode_trayek,
                                    'nomor_bis' => $nomor_bis,
                                    'bis_id' => $bis_id,
                                    'tanggal' => $tanggal
                                ));

                                return back();
                            } 
                            // jika tidak sama
                            else
                            {
                                return back()->with('warning', 'Maaf, Trayek dan Plat Bis tidak sama dengan bis sebelumnya');
                            }
                        }
                    }
                    // Jika sudah ada
                    else
                    {
                        return back()->with('warning', 'Maaf, Nomor Bis sudah digunakan untuk trayek yang sama');
                    }
                }
                // jika sudah ada
                else
                {
                    return back()->with('warning', 'Maaf, Bis pada jadwal trayek ini sudah di tetapkan');
                }

            } 
        }
    }

    public function updateBisBerangkat(Request $request)
    {
        $id = $request->id;
        $tanggal = Convert::tgl_ind_to_eng($request->tanggal);

        $bis = BisBerangkat::find($id);
        $bis->tanggal = $tanggal;
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
