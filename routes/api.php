<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function() {
    Route::apiResource('/auth/register', App\Http\Controllers\Api\RegisterController::class)->only(['store']);
    Route::apiResource('/auth/login', App\Http\Controllers\Api\LoginController::class)->only(['store']);
    Route::apiResource('/quote', App\Http\Controllers\Api\QuoteController::class);
    Route::apiResource('/transaction', App\Http\Controllers\Api\TransactionController::class)->only(['store']);
    Route::apiResource('/transaction/get', App\Http\Controllers\Api\GetTransactionController::class)->only(['store']);
});