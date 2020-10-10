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
Route::get('/{parent}/BuatAnak/', [newContol::class , 'buatanak']);
Route::get('/{aku}/AtokKu/', [newContol::class , 'SiapaAtok']);

//Route::get('/New', 'ShopController@index');