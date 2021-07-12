<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController');

Route::get('/create-table', function(){
   $pasar = 'pasarTest';
   Artisan::call('make:migration create_'.$pasar.'_table');
   echo "oke";
});

/*
   |--------------------------------------------------------------------------
   | Menejement Pasar
   |--------------------------------------------------------------------------
*/
Route::resource('pasar', 'pasar\MasterPasarController');
Route::get('dt/pendaftaran-pedagang/pasar', 'pasar\MasterPasarController@dtPendaftaranPedagang')->name('');

/*
   |--------------------------------------------------------------------------
   | Menejement Lapak Pasar
   |--------------------------------------------------------------------------
*/
Route::resource('lapak', 'pasar\LapakController');
Route::get('dt/lapak', 'pasar\LapakController@dtLapak')->name('dt.lapak');

/*
   |--------------------------------------------------------------------------
   | Data Pedagang
   |--------------------------------------------------------------------------
*/
Route::resource('pedagang', 'pasar\PedagangController');
Route::get('dt/pedagang', 'pasar\PedagangController@dtPedagang')->name('dt.pedagang');

/*
   |--------------------------------------------------------------------------
   | Kontrak Pedagang
   |--------------------------------------------------------------------------
*/
Route::resource('kontrak', 'pasar\KontrakPedagangController');
Route::get('dt/kontrak/verifikasi', 'pasar\KontrakPedagangController@dtKontrak_Verifikasi')->name('dt.kontrakVerifikasi');
Route::get('form/verifikasi/pedagang/{id}', 'pasar\KontrakPedagangController@formVerifikasiPedagang')->name('verifikasiForm.create');


/*
   |--------------------------------------------------------------------------
   | Verifikasi Retribusi
   |--------------------------------------------------------------------------
*/
Route::resource('retribusi', 'pasar\RetribusiController')->except('create');
Route::get('dt/verifikasi', 'pasar\RetribusiController@dtVerifikasi')->name('dt.verifikasi');
Route::get('form/retribusi/{id}', 'pasar\RetribusiController@formRetribusi')->name('retribusi.form');
Route::post('retribusi/pembayaran', 'pasar\RetribusiController@pembayaranRetribusi')->name('retribusi.pembayaran');

/*
   |--------------------------------------------------------------------------
   | Verifikasi riwayat kontrak pedagang
   |--------------------------------------------------------------------------
*/
// perpanjang kontrak
Route::post('riwayat-kontrak/perpanjang', 'pasar\RiwayatKontrakController@perpanjangan')->name('riwayat-kontrak.perpajangan');

/*
   |--------------------------------------------------------------------------
   | Layout Lapak
   |--------------------------------------------------------------------------
*/
Route::get('layout/lapak', 'pasar\LayoutLapakController@index')->name('layout.lapak');

