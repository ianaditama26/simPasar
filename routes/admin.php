<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController');
Route::get('dt/pedagang/sp', 'DashboardController@dtPedagangSp')->name('dt.pedagangSp');

Route::get('/invoice', function(){
   return view('admin.retribusi.invoice');
});

Route::get('/create-table', function(){
   $pasar = 'pasarTest';
   Artisan::call('make:migration create_'.$pasar.'_table');
   echo "oke";
});

// /diskomindag
Route::get('/diskomindag', function(){
   return '/diskomindag';
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

// recyclePedagang
Route::get('daur-ulang/pedagang', 'pasar\PedagangController@recyclePedagang')->name('pedagang.recyclePedagang');
Route::get('dt/daur-ulang/pedagang', 'pasar\PedagangController@dtRecyclePedagang')->name('dt.recyclePedagang');
//restore pedagang
Route::get('restore/pedagang/{id}', 'pasar\PedagangController@restorePedagang');

Route::get('sp/pedagang/detail/{id}', 'pasar\PedagangController@spPedagang_detail');
//? proses request lapak
Route::get('proses/request/pedagang/{id}', 'pasar\PedagangController@prosesRequest_lapak')->name('prosesRequest.lapak');

/*
   |--------------------------------------------------------------------------
   | Kontrak Pedagang
   |--------------------------------------------------------------------------
*/
Route::resource('kontrak', 'pasar\KontrakPedagangController');
Route::get('dt/kontrak/verifikasi', 'pasar\KontrakPedagangController@dtKontrak_Verifikasi')->name('dt.kontrakVerifikasi');
//verifikasi lapak
Route::get('form/verifikasi/pedagang/{id}', 'pasar\KontrakPedagangController@formVerifikasiPedagang')->name('verifikasiForm.create');
// perpanjang kontrak
Route::post('kontrak-pedagang/perpanjang', 'pasar\KontrakPedagangController@perpanjangan')->name('riwayat-kontrak.perpajangan');
//pencabutan kontrak
Route::post('kontrak-pedagang/pencabutan', 'pasar\KontrakPedagangController@pencabutan')->name('riwayat-kontrak.pencabutan');



/*
   |--------------------------------------------------------------------------
   | Retribusi
   |--------------------------------------------------------------------------
*/
Route::resource('retribusi', 'pasar\RetribusiController')->except('create', 'show');
Route::get('dt/verifikasi', 'pasar\RetribusiController@dtVerifikasi')->name('dt.verifikasi');
Route::get('form/retribusi/{id}', 'pasar\RetribusiController@formRetribusi')->name('retribusi.form');
Route::post('retribusi/pembayaran', 'pasar\RetribusiController@pembayaranRetribusi')->name('retribusi.pembayaran');

/*
   |--------------------------------------------------------------------------
   | riwayat kontrak pedagang
   |--------------------------------------------------------------------------
*/
// view riwayat kontrak
Route::get('riwayat/pedagang', 'pasar\RiwayatKontrakController@index')->name('riwayatPedagang.index');
Route::get('dt/riwayat/pedagang/', 'pasar\RiwayatKontrakController@riwayatPedagang')->name('dt.riwayatPedagang');
Route::get('riwayat/pedagang/{id}', 'pasar\RiwayatKontrakController@show')->name('riwayatPedagang.show');

/*
   |--------------------------------------------------------------------------
   | Layout Lapak
   |--------------------------------------------------------------------------
*/
Route::get('layout/lapak', 'pasar\LayoutLapakController@index')->name('layout.lapak');

/*
   |--------------------------------------------------------------------------
   | Pelanggaran pedagang
   |--------------------------------------------------------------------------
*/
Route::get('pelanggara/pedagang', 'pasar\PelanggaranPedagangController@index')->name('pelanggaran.index');
Route::get('dt/pedagang/sp', 'pasar\PelanggaranPedagangController@dtPedagangSp')->name('dt.pedagangSp');

