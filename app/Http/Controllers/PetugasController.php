<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
    	$data['petugas'] = User::where('level', '!=', 'root')->get();
    	$data['menu'] = 'petugas';
    	return view('petugas', $data);
    }

    public function insertPetugas(Request $request)
    {
    	$data = $request->all();
    	$data['password'] = bcrypt($request->password);
    	
    	User::create($data);
    	return back();
    }

    public function resetPassword(Request $request)
    {
    	$password = bcrypt($request->password);
    	$level = $request->level;
    	
    	$user = User::find($request->id);
    	$user->password = $password;
    	$user->level = $level;
    	$user->save();

    	return back();
    }

    public function deletePetugas($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	return back();
    }

    public function detailPetugas()
    {
        $menu = 'petugas';
        return view('detail-petugas')->with('menu', $menu);
    }

    public function updatePetugas(Request $request)
    {
        $user = User::find($request->id);
        $user->petugas = $request->petugas;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        return back();
    }
}
