<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => '/v1'], function () {
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Api\UserController::class, 'store']);
        Route::get('/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\UserController::class, 'delete']);
        Route::put('/{id}/edit', [\App\Http\Controllers\Api\UserController::class, 'update']);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
