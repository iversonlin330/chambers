<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\ManageFileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TodoController;
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
    return view('login');
});

//Route::get('home', function () {
//    return view('welcome');
//});

Route::get('hours/export', [HourController::class, 'export']);
Route::post('hours/{id}/export', [HourController::class, 'export']);

Route::get('manage-files/step1', [ManageFileController::class, 'step1']);
Route::get('manage-files/step2', [ManageFileController::class, 'step2']);
Route::get('manage-files/step3', [ManageFileController::class, 'step3']);

Route::resource('costs', CostController::class);
Route::resource('events', EventController::class);
Route::resource('hours', HourController::class);
Route::resource('white-lists', WhiteListController::class);
Route::resource('logs', LogController::class);
Route::resource('todos', TodoController::class);


