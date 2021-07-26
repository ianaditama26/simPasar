<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

Route::get('/created', function () {
    User::factory()->create();
    return Activity::all()->last();
});

Route::get('/update', function () {
    
    return Activity::all()->last();
});

Route::get('/', function () {
    return view('walcome');
});


/*
    |--------------------------------------------------------------------------
    | Auth fronted
    |--------------------------------------------------------------------------
*/
// Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
