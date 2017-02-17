<?php

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

Route::get('/', 'SsoController@index');
Route::post('/login','SsoController@login');
Route::group(['middleware' => 'logincheck'], function () {
	Route::get('/user','UserController@index');
});
Route::get('/logout','SsoController@logout');