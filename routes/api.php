<?php

use App\Http\Controllers\api\AuthController;
//use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);



    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

});


Route::post('/login', [AuthController::class, 'login']);
