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
    Route::get('mapelBy/{key}/{val}', 'API\MapelController@mapelByKey');
});
