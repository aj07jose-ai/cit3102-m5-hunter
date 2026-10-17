<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HunterController;

// Public authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/hunters', [HunterController::class, 'index']);
    Route::post('/hunters', [HunterController::class, 'store']);
    Route::get('/hunters/{hunter}', [HunterController::class, 'show']);
    Route::put('/hunters/{hunter}', [HunterController::class, 'update']);
    Route::delete('/hunters/{hunter}', [HunterController::class, 'destroy']);
});