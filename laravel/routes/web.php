<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lists;

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

Route::get('/', [Lists::class, 'index']);

Route::post('/ajaxtask',[Lists::class, 'add']);

Route::get('getdata',[Lists::class,'get_data']);

Route::post('showalldata',[Lists::class,'showalldata']);

Route::get('getalldata',[Lists::class,'getalldata']);

Route::post('updatedata',[Lists::class,'updatedata']);

Route::post('deletedata',[Lists::class,'deletedata']);

