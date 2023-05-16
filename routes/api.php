<?php

use App\Infrastructure\Controllers\PostBuyCoinController;
use App\Infrastructure\Controllers\GetBuyCoinController;
use App\Infrastructure\Controllers\GetWalletCriptosController;
use App\Infrastructure\Controllers\GetWalletOpenController;
use App\Infrastructure\Controllers\GetStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/status', GetStatusController::class);
Route::get('/wallet/open/{id}', GetWalletOpenController::class);
Route::get('/coin/buy/{id}/{id2}', PostBuyCoinController::class);
Route::get('/wallet/{wallet_id}', GetWalletCriptosController::class);
