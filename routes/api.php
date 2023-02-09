<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Api\AuthController::class, 'refresh']);

    Route::prefix('my_account')->group(function () {
        Route::patch('/update', [\App\Http\Controllers\Api\UserController::class, 'update']);
        Route::get('/view', [\App\Http\Controllers\Api\UserController::class, 'view']);
        Route::get('/orders', [\App\Http\Controllers\Api\UserController::class, 'get_orders']);
        Route::get('/orders/{id}', [\App\Http\Controllers\Api\UserController::class, 'order_detail']);
    });

    Route::prefix('orders')->group(function () {
        Route::post('/payment', [\App\Http\Controllers\Api\OrderController::class, 'payment']);
    });
    Route::prefix('user_shipping')->group(function () {
        Route::get('/get_address', [\App\Http\Controllers\Api\ShippingController::class, 'user_address']);
        Route::post('/create', [\App\Http\Controllers\Api\ShippingController::class, 'create_address']);
        Route::patch('/select/{id}', [\App\Http\Controllers\Api\ShippingController::class, 'select_shipping']);
    });
});

Route::prefix('categories')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('/detail/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'detailCategory']);
});

Route::prefix('products')->group(function () {
    Route::get('/index', [\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/detail/{id}', [\App\Http\Controllers\Api\ProductController::class, 'detailProduct']);
});
