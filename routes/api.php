<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'API\UsersController@login');
Route::post('register', 'API\UsersController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UsersController@details');
    Route::post('updateUser/{id}', 'API\UsersController@update');
    Route::get('mapel', 'API\MapelController@showMapel');
    Route::post('addMapel', 'API\MapelController@store');
    Route::get('mapelBy/{kelas}/{mapel}', 'API\MapelController@mapelByKey');
    Route::post('addRiwayatPendidikan', 'API\RiwayatPendidikanController@store');
    Route::get('riwayatPendidikan/{tentor}', 'API\RiwayatPendidikanController@riwayat');
    Route::post('addInfo/{tentor}', 'API\TentorController@addInfoTentor');
    Route::get('getInfo/{tentor}', 'API\TentorController@getInfoTentor');
    Route::post('addDataMengajar', 'API\TentorController@addDataMengajar');
    Route::get('getTentor/{mapel}', 'API\TentorController@getListTentor');
    Route::post('addPrestasi', 'API\PrestasiController@addPrestasi');
    Route::get('getPrestasi/{tentor}', 'API\PrestasiController@getPrestasi');
    Route::post('tambahKelas', 'API\KelasController@addKelas');
    Route::get('listKelas/{user}', 'API\KelasController@listKelas');
    Route::post('pembayaran', 'API\PembayaranController@pembayaran');
    Route::post('konfirmasi/{log}', 'API\PembayaranController@konfirmasi');
    Route::get('logPembayaran/{kelas}', 'API\PembayaranController@logPembayaran');
    Route::get('kelasTentor/{kelas}', 'API\KelasController@detailKelasByTentor');
    Route::get('kelasSiswa/{kelas}', 'API\KelasController@detailKelasBySiswa');
});
