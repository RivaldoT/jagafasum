<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ReportController;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('/dinas', DinasController::class)->parameters([
        // Menghindari Pemangkasan Plural 's'
        'dinas' => 'dinas'
    ]);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/cities', CityController::class);
    Route::resource('/fasilitas', FasilitasController::class);
    Route::resource('/report', ReportController::class);
});