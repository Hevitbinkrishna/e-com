<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/products', [HomeController::class,'index']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/cart', [CartController::class,'store']);
    Route::delete('/cart/{id}', [CartController::class,'destroy']);
    Route::post('/order', [OrderController::class,'store']);
});
