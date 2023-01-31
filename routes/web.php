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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

//Page admin
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'indexAdmin'])->name('admin');
//Page home
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'indexCus'])->name('home');

// Manage
Route::group(['middleware' => ['auth', 'permission']], function() {
    // Manage users
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users-update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::get('/users-delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

// Manage roles
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles-update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles-delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');

// Manage categories
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/view', [App\Http\Controllers\CategoryController::class, 'view'])->name('categories.view');
    Route::get('/categories/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories-update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories-delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

// Manage products
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/view', [App\Http\Controllers\ProductController::class, 'view'])->name('products.view');
    Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products-update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::get('/products-delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
});

// Test
Route::get('/products/test', [App\Http\Controllers\ProductController::class, 'test'])->name('products.test');

