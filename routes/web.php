<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
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
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::patch('dashboard/update/profile', [\App\Http\Controllers\DashboardController::class, 'editProfile'])->name('dashboard.edit-profile');
});
