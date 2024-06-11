<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});

Route::resource('data', DataController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);

Route::resource('audio', AudioController::class)->only(['index', 'store', 'destroy']);

Route::resource('location', LocationController::class)->only(['index', 'store']);
