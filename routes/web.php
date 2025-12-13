<?php


use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthorsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| WEBSITE ROUTES
|--------------------------------------------------------------------------
| Device middleware required
*/

Route::middleware('device')->group(function () {

    // // Testing
    // Route::get('/testing', function () {
    //     return ['message' => 'API is working!'];
    // });

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);

    // Authors
    Route::get('/authors', [AuthorsController::class, 'index']);
    Route::get('/authors/{id}', [AuthorsController::class, 'show']);

    // Blogs
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);

    // Questions (Quiz)
    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/questions/{question}', [QuestionController::class, 'show']);

    // Device sync
    Route::post('/device/web-sync', [DeviceController::class, 'syncDeviceWeb']);
});
