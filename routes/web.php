<?php

use App\Http\Controllers\DashboardController;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FasilitasController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home-page');
    Route::get('/report/{id}/details', [ReportController::class, 'getReportDetails'])->name('report.details');
    Route::resource('/dinas', DinasController::class)->parameters([
        // Menghindari Pemangkasan Plural 's'
        'dinas' => 'dinas'
    ]);
    Route::resource('/users', UserController::class);
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::put('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/cities', CityController::class);
    Route::resource('/fasilitas', FasilitasController::class);
    Route::resource('/report', ReportController::class);
});
Auth::routes();
