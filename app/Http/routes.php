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

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('/', 'TiketController@index');

Route::group(['middleware' => 'auth'], function() {

	Route::post('pesan-tiket', 'TiketController@pesanTiket');
	Route::post('bayar-tiket', 'TiketController@bayarTiket');
	Route::get('cetak-tiket', 'TiketController@cetakTiket');
	Route::post('batal-tiket', 'TiketController@batalTiket');
	Route::get('edit-tiket', 'TiketController@editTiket');
	Route::post('update-tiket', 'TiketController@updateTiket');

	Route::get('pesanan', 'TiketController@dataPesanan');
	Route::get('pesanan-export', 'TiketController@pesananExport');
	Route::get('pesanan-cetak', 'TiketController@pesananCetak');

	Route::get('trayek', 'TrayekController@index');
	Route::post('trayek', 'TrayekController@insertTrayek');
	Route::post('detail-trayek', 'TrayekController@insertDetailTrayek');
	Route::get('delete-trayek/{id}', 'TrayekController@deleteTrayek');
	Route::get('delete-detail-trayek/{id}', 'TrayekController@deleteDetailTrayek');

	Route::get('bis-default', 'BisController@bisDefault');
	Route::post('bis-default', 'BisController@insertBisDefault');
	Route::post('bis-default-update', 'BisController@updateBisDefault');
	Route::get('bis-berangkat', 'BisController@bisBerangkat');
	Route::post('bis-berangkat', 'BisController@insertBisBerangkat');
	Route::post('bis-tambahan', 'BisController@insertBisTambahan');
	Route::post('bis-berangkat/update', 'BisController@updateBisBerangkat');
	Route::get('bis-berangkat/delete', 'BisController@deleteBisBerangkat');
	Route::get('bis', 'BisController@dataBis');
	Route::post('bis', 'BisController@insertDataBis');
	Route::get('bis-delete/{id}', 'BisController@deleteDataBis');

	Route::get('petugas', 'PetugasController@index');
	Route::post('petugas', 'PetugasController@insertPetugas');
	Route::get('petugas-detail', 'PetugasController@detailPetugas');
	Route::post('reset-password', 'PetugasController@resetPassword');
	Route::post('update-petugas', 'PetugasController@updatePetugas');
	Route::get('delete-petugas/{id}', 'PetugasController@deletePetugas');

	Route::get('log-pesanan', 'LogController@logPesanan');
	Route::get('log-pesanan-data', 'LogController@logPesananData');

	Route::get('log-petugas',  'LogController@logPetugas');
	Route::get('log-petugas/detail/{id}', 'LogController@logPetugasDetail');

	Route::get('log-petugas-harian', 'LogController@logPetugasHarian');
	Route::get('log-petugas-harian/detail/{id}', 'LogController@logPetugasHarianDetail');
	
	Route::get('log-administrasi', 'LogController@logAdministrasi');

});

Route::get('test-print-tiket', function() {
	return view('print.tiket');
});