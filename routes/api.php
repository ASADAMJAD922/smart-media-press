<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/testing', function () {
    return ['message' => 'API is working!'];
});


Route::middleware('device')->group(function () {
    // Auth Controller
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Device Controller
    Route::post('/device/web-sync', [DeviceController::class, 'syncDeviceWeb']);
});

// Post authenticated route
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
