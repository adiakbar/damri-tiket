<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Trayek;
use Illuminate\Http\Request;

class TrayekController extends Controller
{
    public function index()
    {
    	$trayek = Trayek::all();

    	$data['trayek'] = $trayek;

    	return view('trayek', $data);
    }
}
