<?php

use App\Infrastructure\Controllers\CrearUserController;
use App\Infrastructure\Controllers\CreateWalletFromRequest;
use App\Infrastructure\Controllers\PostBuyCoinController;
use App\Infrastructure\Controllers\GetWalletCriptosController;
use App\Infrastructure\Controllers\CreateWalletController;
use App\Infrastructure\Controllers\GetStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/status', GetStatusController::class);
Route::post('/wallet/open', CreateWalletFromRequest::class);
Route::get('/coin/buy/{id}/{id2}', PostBuyCoinController::class);
Route::get('/wallet/{wallet_id}', GetWalletCriptosController::class);
Route::get('/user/{id}', CrearUserController::class);
