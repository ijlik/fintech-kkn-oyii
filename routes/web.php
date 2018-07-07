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

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/ganti-password', 'HomeController@gantiPassword');
Route::get('/makan', 'HomeController@formMakan');
Route::get('/riwayat-makan', 'HomeController@showMakan');
Route::post('/makan', 'HomeController@createMakan');
Route::get('/absen', 'HomeController@formAbsen');
Route::get('/riwayat-absen', 'HomeController@showAbsen');
Route::post('/absen', 'HomeController@createAbsen');
Route::get('/pemasukan', 'HomeController@formPemasukan');
Route::post('/pemasukan', 'HomeController@createPemasukan');
Route::get('/riwayat-pemasukan', 'HomeController@showPemasukan');
Route::get('/kas', 'HomeController@showKas');

Route::get('/laporan-kas', 'HomeController@reportKas');
Route::get('/laporan-absen', 'HomeController@reportAbsen');
Route::get('/laporan-makan', 'HomeController@reportMakan');

Route::get('/setting-user', 'HomeController@formSettingUser');
Route::post('/setting-user', 'HomeController@updateUser');
// Route::get('/lalala', 'HomeController@lalala');