<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ecommerceController;
use App\Http\Controllers\transaksiController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::group(['prefix' => 'public'], function () {
        Route::resource('ecommerce', ecommerceController::class, ['only' => ['index']]);
        Route::resource('transaksi', transaksiController::class, ['only' => ['store', 'show']]);
    });
    
    Route::group(['prefix' => 'admin'], function() {
        Route::resource('transaksi', transaksiController::class, ['only' => ['index', 'update', 'destroy']]);
        Route::resource('ecommerce', ecommerceController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
    });
});
