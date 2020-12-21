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

Route::get('/', function () {
    return view('welcome');
});

Route::get('tabel', function() {
    return view('tabel');
});

Route::post('tabel', 'TableController@show') -> name('tabelus');

//Route::get('tabel/{name}', 'TableController@getBrandData') -> name('tabal');

Route::post('tabel/{name}', 'TableController@getBrandData') -> name('tabale');

