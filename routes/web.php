<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\StopController;
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

Route::get('/', [TripController::class, 'index']);
Route::resource('trips', TripController::class)->parameters(['trips'=>'trip:slug']);
Route::resource('days', DayController::class);

Route::resource('stops', StopController::class);


