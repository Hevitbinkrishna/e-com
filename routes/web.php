<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/cart', [CartController::class,'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class,'destroy'])->name('cart.destroy');

    Route::get('/orders', [OrderController::class,'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class,'store'])->name('orders.store');
});

// Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function(){
    Route::resource('products', AdminProductController::class);
});
