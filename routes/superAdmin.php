<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController');

/*
   |--------------------------------------------------------------------------
   | Master Lapak
   |--------------------------------------------------------------------------
*/
Route::resource('master-lapak', 'MasterData\LapakController');
Route::get('dt/master-lapak', 'Masterdata\LapakController@dtLapak')->name('dt.masterLapak');

/*
   |--------------------------------------------------------------------------
   | Master Zona Lapak
   |--------------------------------------------------------------------------
*/
Route::resource('master-zona-lapak', 'MasterData\ZonaLapakController');
Route::get('dt/master-zona-lapak', 'Masterdata\ZonaLapakController@dtZonaLapak')->name('dt.zonaLapak');

/*
   |--------------------------------------------------------------------------
   | Master Komoditas
   |--------------------------------------------------------------------------
*/
Route::resource('master-komoditas', 'MasterData\KomoditasController');
Route::get('dt/master-komoditas', 'MasterData\KomoditasController@dtKomoditas')->name('dt.masterKomoditas');

/*
   |--------------------------------------------------------------------------
   | Master Pasar
   |--------------------------------------------------------------------------
*/
Route::resource('pasar', 'MasterData\PasarController');
Route::get('dt/pasar', 'MasterData\PasarController@dtPasar')->name('dt.pasar');

/*
   |--------------------------------------------------------------------------
   | Master kelas
   |--------------------------------------------------------------------------
*/
Route::resource('master-kelas', 'MasterData\KelasController');
Route::get('dt/master-kelas', 'MasterData\KelasController@dtKelas')->name('dt.masterKelas');

/*
   |--------------------------------------------------------------------------
   | User
   |--------------------------------------------------------------------------
*/
Route::resource('user', 'MasterData\UserController');

/*
   |--------------------------------------------------------------------------
   | Log activity
   |--------------------------------------------------------------------------
*/
Route::get('log-activity', 'LogActivityController@index')->name('log-activity.index');
Route::get('dt/log-activity', 'LogActivityController@dtLogActivity')->name('dt.log-activity');