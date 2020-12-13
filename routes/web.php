<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'Admin'], function () {
    Route::get('/logout', 'UsersController@logout');
    Route::get('/dashboard', 'UsersController@dashboard');
    Route::resource('/siswa', 'SiswaController');
    Route::resource('/tentor', 'TentorController');
    Route::resource('/user', 'UsersController');
    Route::resource('/mapel', 'MapelController');
    Route::resource('/dataMengajar', 'DataMengajarController');
    Route::get('/jadwal', 'JadwalController@index');
    Route::resource('/pembayaran', 'PembayaranController');
});
