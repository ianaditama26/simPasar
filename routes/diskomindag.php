<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DikomindagController@dashboard')->name('diskomindag.dashboard');
Route::get('/data-pedagang', 'DikomindagController@index')->name('data.pedagang');
Route::get('dt/status-proses/pedagang', 'DikomindagController@dtStatusProsesPedagang')->name('dt.statusProsesPedagang');
//verified
Route::get('/verified/pedagang/{id}', 'DikomindagController@verifiedPedagang')->name('verified.pedagang');
//denied
Route::get('/denied/pedagang/{id}', 'DikomindagController@deniedPedagang')->name('denied.pedagang');