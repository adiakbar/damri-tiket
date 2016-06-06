<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'TiketController@index');
Route::post('/pesan-tiket', 'TiketController@pesanTiket');
Route::post('/bayar-tiket', 'TiketController@bayarTiket');
Route::get('/cetak-tiket', 'TiketController@cetakTiket');


Route::get('trayek', 'TrayekController@index');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
