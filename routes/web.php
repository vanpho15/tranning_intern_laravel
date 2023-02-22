<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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

Route::get('/', [AuthController::class, 'index']);
Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/login/store', [AuthController::class, 'store'])->name('admin.store');
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin.index');
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::prefix('/user')->group(function () {
            Route::get('/add', [UserController::class, 'add'])->name('user.add');
            Route::post('/handleAdd', [UserController::class, 'handleAdd'])->name('user.handleAdd');
            Route::get('/edit/{id}', [UserController::class, 'edit']);
            Route::post('/handleEdit/{id}', [UserController::class, 'handleEdit'])->name('user.handleEdit');
            Route::post('/import', [UserController::class, 'import'])->name('user.import');
            Route::get('/export', [UserController::class, 'export'])->name('user.export');
            Route::post('/search', [UserController::class, 'search'])->name('user.search');
            Route::get('/search', [UserController::class, 'forgetSessionSearch'])->name('user.deleteSessionSearch');
            Route::get('/destroy', [UserController::class, 'destroy']);
        });
        Route::prefix('/category')->group(function () {
            Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
            Route::post('/handleAdd', [CategoryController::class, 'handleAdd'])->name('category.handleAdd');
            Route::get('/edit/{id}', [CategoryController::class, 'edit']);
            Route::post('/handleEdit/{id}', [CategoryController::class, 'handleEdit'])->name('category.handleEdit');
            Route::get('/search', [CategoryController::class, 'listCategory'])->name('category.list');
            Route::get('/destroy', [CategoryController::class, 'destroy']);
            Route::post('/search', [CategoryController::class, 'search'])->name('category.search');
            Route::get('/search/clear', [CategoryController::class, 'forgetSessionSearch'])->name('category.deleteSessionSearch');
        });
        Route::prefix('/product')->group(function () {
            Route::get('/add', [ProductController::class, 'add'])->name('product.add');
            Route::post('/handleAdd', [ProductController::class, 'handleAdd'])->name('product.handleAdd');
            Route::get('/edit/{id}', [ProductController::class, 'edit']);
            Route::post('/handleEdit/{id}', [ProductController::class, 'handleEdit'])->name('product.handleEdit');
            Route::get('/search', [ProductController::class, 'listProduct'])->name('product.list');
            Route::get('/destroy', [ProductController::class, 'destroy']);
            Route::post('/search', [ProductController::class, 'search'])->name('product.search');
            Route::get('/search/clear', [ProductController::class, 'forgetSessionSearch'])->name('product.deleteSessionSearch');
            Route::get('/export', [ProductController::class, 'export'])->name('product.export');
            Route::post('/import', [ProductController::class, 'import'])->name('product.import');
        });
        Route::get('/not-found', function () {
            return view('admin.screen.errors.403');
        })->name('error.forbidden');
    });
});
