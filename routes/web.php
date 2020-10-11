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


use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ShopController;

Route::get('/New', [ShopController::class , 'index']);


use App\Http\Controllers\newContol;

Route::get('/NewC', [newContol::class , 'index']);
Route::get('/sponsor', [newContol::class , 'index2']);
Route::get('/{aku}/keluargaku', [newContol::class , 'keluargaku']);
Route::get('/{parent}/buatanak/', [newContol::class , 'buatanak']);
Route::get('/{aku}/punyaAtok/', [newContol::class , 'punyaAtok']);
Route::get('/{aku}/UntungSponsor/', [newContol::class , 'UntungSponsor']);
//Route::get('/New', 'ShopController@index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
