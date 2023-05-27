<?php

use App\Infrastructure\Controllers\BuyCoinFormRequest;
use App\Infrastructure\Controllers\CreateUserController;
use App\Infrastructure\Controllers\CreateWalletFromRequest;
use App\Infrastructure\Controllers\GetStatusController;
use App\Infrastructure\Controllers\SellCoinFormRequest;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Controllers\GetWalletCoinsRequest;

Route::get('/status', GetStatusController::class);
Route::post('/wallet/open', CreateWalletFromRequest::class);
Route::post('/coin/buy', BuyCoinFormRequest::class);
Route::post('/coin/sell', SellCoinFormRequest::class);
Route::get('/wallet/{wallet_id}', GetWalletCoinsRequest::class);
Route::get('/user/{id}', CreateUserController::class);
