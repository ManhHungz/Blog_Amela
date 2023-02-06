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
});

Route::prefix('categories')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
        Route::get('/detail/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'detailCategory']);
});

Route::prefix('products')->group(function () {
        Route::get('/index', [\App\Http\Controllers\Api\ProductController::class, 'index']);
        Route::get('/detail/{id}', [\App\Http\Controllers\Api\ProductController::class, 'detailProduct']);
        Route::get('/search/{name}', [\App\Http\Controllers\Api\ProductController::class, 'search']);
});
