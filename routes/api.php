<?php

<<<<<<< HEAD
use App\Infrastructure\Controllers\PostBuyCoinController;
=======
use App\Infrastructure\Controllers\GetBuyCoinController;
use App\Infrastructure\Controllers\GetWalletCriptosController;
>>>>>>> 7ee0347db462a49bc43a88e9271a30078abd8c0b
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
<<<<<<< HEAD
Route::get('/coin/buy/{id}/{id2}', PostBuyCoinController::class);
=======
Route::get('/wallet/{wallet_id}', GetWalletCriptosController::class);
Route::get('/coin/buy/{id}/{id2}', GetBuyCoinController::class);
>>>>>>> 7ee0347db462a49bc43a88e9271a30078abd8c0b
