<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\WhiteListController;
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

Route::resource('costs', CostController::class);
Route::resource('events', EventController::class);
Route::resource('hours', HourController::class);
Route::resource('white-lists', WhiteListController::class);
Route::resource('logs', LogController::class);
