<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UptController@dashboard')->name('upt.dashboard');
Route::get('/data-pedagang', 'UptController@index')->name('data.pedagang');
Route::get('dt/status-proses/pedagang', 'UptController@dtStatusProsesPedagang')->name('dt.statusProsesPedagang');
//* isVarified_upt
Route::get('pedagang/verified/upt/{id}', 'UptController@idVerified_upt')->name('statusPedagang.isVefied_upt');
//! denied
Route::get('/denied/pedagang/{id}', 'UptController@deniedPedagang')->name('denied.pedagang');

/*
   |--------------------------------------------------------------------------
   | Kontrak Pedagang
   |--------------------------------------------------------------------------
*/
Route::get('/kontrak/pedagang', 'KontrakPedagangController@index')->name('kontrak.index');
Route::get('dt/kontrak/verifikasi', 'KontrakPedagangController@dtKontrak_Verifikasi')->name('dt.kontrakVerifikasi');
Route::get('/kontrak/detail/{id}', 'KontrakPedagangController@show');

/*
   |--------------------------------------------------------------------------
   | Riwayat Pedagang
   |--------------------------------------------------------------------------
*/
// view riwayat kontrak
Route::get('riwayat/pedagang', 'RiwayatKontrakController@index')->name('riwayatPedagang.index');
Route::get('dt/riwayat/pedagang/', 'RiwayatKontrakController@riwayatPedagang')->name('dt.riwayatPedagang');
Route::get('riwayat/pedagang/{id}', 'RiwayatKontrakController@show')->name('riwayatPedagang.show');

/*
   |--------------------------------------------------------------------------
   | Pelanggaran pedagang
   |--------------------------------------------------------------------------
*/
Route::get('pelanggara/pedagang', 'PelanggaranPedagangController@index')->name('pelanggaran.index');
Route::get('dt/pedagang/sp', 'PelanggaranPedagangController@dtPedagangSp')->name('dt.pedagangSp');