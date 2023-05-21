<?php

use App\Infrastructure\Controllers\BuyCoinFormRequest;
use App\Infrastructure\Controllers\CreateUserController;
use App\Infrastructure\Controllers\CreateWalletFromRequest;
use App\Infrastructure\Controllers\GetWalletCriptosController;
use App\Infrastructure\Controllers\GetStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/status', GetStatusController::class);
Route::post('/wallet/open', CreateWalletFromRequest::class);
Route::post('/coin/buy', BuyCoinFormRequest::class);
Route::get('/wallet/{wallet_id}', GetWalletCriptosController::class);
Route::get('/user/{id}', CreateUserController::class);
