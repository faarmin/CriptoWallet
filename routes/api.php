<?php

use App\Infrastructure\Controllers\GetBuyCoinController;
use App\Infrastructure\Controllers\GetWalletOpenController;
use App\Infrastructure\Controllers\GetStatusController;
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


Route::get('/status', GetStatusController::class);
Route::get('/wallet/open/{id}', GetWalletOpenController::class);
Route::get('/coin/buy/{id}/{id2}', GetBuyCoinController::class);
