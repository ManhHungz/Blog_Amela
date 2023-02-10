<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Page admin
Route::get('/', [App\Http\Controllers\HomeController::class, 'indexAdmin'])->name('admin');

// Manage
Route::group(['middleware' => ['auth', 'permission']], function () {
    // Manage users
    Route::prefix('users')->group(function () {
        Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::patch('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });

// Manage roles
    Route::prefix('roles')->group(function () {
        Route::get('/index', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
        Route::get('/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    });

// Manage categories
    Route::prefix('categories')->group(function () {
        Route::get('/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{id}/view', [App\Http\Controllers\CategoryController::class, 'view'])->name('categories.view');
        Route::get('/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
    });

// Manage products
    Route::prefix('products')->group(function () {
        Route::get('/index', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}/view', [App\Http\Controllers\ProductController::class, 'view'])->name('products.view');
        Route::get('/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::put('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    });

// Manage orders
    Route::prefix('orders')->group(function () {
        Route::get('/index', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::get('/view/{id}', [App\Http\Controllers\OrderController::class, 'view'])->name('orders.view');
        Route::put('/complete/{id}', [App\Http\Controllers\OrderController::class, 'complete'])->name('orders.complete');
        Route::put('/refuse/{id}', [App\Http\Controllers\OrderController::class, 'refuse'])->name('orders.refuse');
    });
});
