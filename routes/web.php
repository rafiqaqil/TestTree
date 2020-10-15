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

use App\Http\Controllers;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ShopController;
use App\Http\Controllers\DM3treeController;
use App\Http\Controllers\DM5treeController;
use App\Http\Controllers\HomeController;


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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  //DM5 ROUTESSS

Route::get('/DM5', [DM5treeController::class , 'index']);
Route::get('/DM5/tambahMember/{namaDia}', [DM5treeController::class , 'tambahMember']);
Route::get('/DM5/tambahMemberSoftly/{namaDia}', [DM5treeController::class , 'tambahMemberSoftly']);

  //DM3 ROUTESSS

Route::get('/DM3', [DM3treeController::class , 'index']);
Route::get('/DM3/tambahMember/{namaDia}', [DM3treeController::class , 'tambahMember']);
Route::get('/DM3/tambahMemberSoftly/{namaDia}', [DM3treeController::class , 'tambahMemberSoftly']);
