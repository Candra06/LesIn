<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'UsersController@home');
Route::post('/login', 'UsersController@login');
Route::get('migrate', function () {
    Artisan::call('migrate');
});
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::group(['middleware' => 'Admin'], function () {
    Route::get('/logout', 'UsersController@logout');
    Route::get('/dashboard', 'UsersController@dashboard');
    Route::resource('/siswa', 'SiswaController');
    Route::resource('/tentor', 'TentorController');
    Route::resource('/user', 'UsersController');
    Route::resource('/mapel', 'MapelController');
    Route::resource('/rekening', 'RekeningController');
    Route::resource('/dataMengajar', 'DataMengajarController');
    Route::get('/jadwal', 'JadwalController@index');
    Route::get('/kelas', 'KelasController@listKelas');
    Route::get('/kelas/{id}', 'KelasController@show');
    Route::get('/gajiTentor', 'TentorController@listTentor');
    Route::get('/profile/{id}', 'UsersController@show');
    Route::put('/profile/{id}', 'UsersController@update');

    Route::get('/pencairan/{tentor}/', 'TentorController@pencairan');
    Route::post('/pencairan/{tentor}', 'TentorController@pencairanSaldo');
    Route::resource('/pembayaran', 'PembayaranController');
});
