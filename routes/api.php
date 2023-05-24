<?php

use App\Infrastructure\Controllers\CreateUserController;
use App\Infrastructure\Controllers\CreateWalletFromRequest;
use App\Infrastructure\Controllers\PostBuyCoinController;
use App\Infrastructure\Controllers\GetWalletCriptosController;
use App\Infrastructure\Controllers\CreateWalletController;
use App\Infrastructure\Controllers\GetStatusController;
use App\Infrastructure\Controllers\SellCoinFormRequest;
use Illuminate\Support\Facades\Route;

Route::get('/status', GetStatusController::class);
Route::post('/coin/sell', SellCoinFormRequest::class);
Route::post('/wallet/open', CreateWalletFromRequest::class);
Route::get('/user/{id}', CreateUserController::class);
