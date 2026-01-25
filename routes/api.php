<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;

//New 

//Flutter Api
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/products', [ProductController::class, 'apiIndex'])->name('products.apiIndex');
Route::get('/discount',[ProductController::class,'DiscountProducts']);
Route::get('/categoryproducts', [ProductController::class, 'byCategory']);
Route::get('/products/{id}',[ProductController::class,'showDetails']);


Route::middleware(['auth:sanctum', 'customer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'store']);
    Route::delete('/cart/{cartItem}',[CartController::class, 'remove']);
    Route::put('cart/{cartItem}', [CartController::class, 'update']);
    Route::post('/logout',[AuthController::class,'logout']);
});



