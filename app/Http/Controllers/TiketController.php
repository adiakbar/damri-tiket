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

            $kode_trayek = JenisBisTrayek::find($jenis_bis_trayek_id)->kode_trayek;

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
            $data['jenis_bis_trayek_id'] = $jenis_bis_trayek_id;
        }
       
        $data['trayek'] = json_encode($array_trayek);

    	return view('pesan-tiket', $data);
    }

    public function pesanTiket(Request $request)
    {
        $data = $request->all();
        
        Pesanan::create($data);

        return redirect()->back();
    }

}
