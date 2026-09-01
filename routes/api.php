<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;

// 1. Endpoint Login (Terbuka/Public)
    Route::post('/login', [AuthController::class, 'login']);

// 2. Endpoint Terproteksi Token Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // CRUD Kategori & Buku
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('books', BookController::class);
});