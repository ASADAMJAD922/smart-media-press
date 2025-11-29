<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/testing', function () {
    return ['message' => 'API is working!'];
});


Route::middleware('device')->group(function () {

    // Auth Controller
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login-confirm', [AuthController::class, 'verifyOtp']);
    Route::post('/login-resend', [AuthController::class, 'resendCode']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // Device Controller
    Route::post('/device/web-sync', [DeviceController::class, 'syncDeviceWeb']);
});

// Post authenticated route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
