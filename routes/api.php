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
Route::post('requestPassword', 'API\UsersController@requestPassword');
Route::post('resetPassword', 'API\UsersController@resetPassword');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UsersController@profil');
    Route::post('updateUser', 'API\UsersController@update');
    Route::get('mapel', 'API\MapelController@showMapel');
    Route::post('addMapel', 'API\MapelController@store');
    Route::get('mapelBy/{kelas}/{mapel}', 'API\MapelController@mapelByKey');
    Route::post('addRiwayatPendidikan', 'API\RiwayatPendidikanController@store');
    Route::get('riwayatPendidikan/{tentor}', 'API\RiwayatPendidikanController@riwayat');
    Route::post('addInfo/{tentor}', 'API\TentorController@addInfoTentor');
    Route::get('getInfo/{tentor}', 'API\TentorController@getInfoTentor');
    Route::post('addDataMengajar', 'API\TentorController@addDataMengajar');
    Route::get('getDataMengajar', 'API\DataMengajarController@index');
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
    Route::delete('prestasi/{id}', 'API\PrestasiController@delete');
    Route::delete('dataMengajar/{id}', 'API\TentorController@deleteDataMengajar');
    Route::delete('pendidikan/{id}', 'API\RiwayatPendidikanController@delete');
    Route::post('createChat', 'API\ChatController@createChat');
    Route::get('listRoom', 'API\ChatController@listChat');
    Route::get('detailChat/{room}', 'API\ChatController@detailChat');
    Route::get('listJadwal', 'API\JadwalController@listJadwal');
    Route::get('listPembayaran', 'API\PembayaranController@listPembayaran');
    Route::post('absensi', 'API\AbsensiController@store');
    Route::get('absensi/{kelas}', 'API\AbsensiController@index');
    Route::get('modul/{kelas}', 'API\ModulController@index');
    Route::post('modul', 'API\ModulController@store');
    Route::post('deletePendidikan/{id}', 'API\RiwayatPendidikanController@delete');
    Route::post('deletePrestasi/{id}', 'API\PrestasiController@delete');
    Route::get('saldo', 'API\TentorController@getSaldo');
    Route::get('rekening', 'API\RekeningController@index');
    Route::post('feedback', 'API\FeedbackController@simpan');
});
