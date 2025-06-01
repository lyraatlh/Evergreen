<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// Halaman awal
Route::get('/', function () {
    return view('auth.login');
});

// Authentication
Route::get('/register', [AuthController::class, "register"])->name('auth.register');
Route::get('/login', [AuthController::class, "login"])->name('auth.login');
Route::post('/register', [AuthController::class, "store"])->name('auth.store');
Route::post('/login', [AuthController::class, "authenticate"])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, "logout"])->name('auth.logout');;

// Admin
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Product routes
    Route::get('/plants', [ProductController::class, 'index'])->name('plants.index');
    Route::get('/plants/create', [ProductController::class, 'create'])->name('plants.create');
    Route::post('/plants', [ProductController::class, 'store'])->name('plants.store');
    Route::get('/plants/{id}', [ProductController::class, 'show'])->name('plants.show');
    Route::get('/plants/{id}/edit', [ProductController::class, 'edit'])->name('plants.edit');
    Route::put('/plants/{id}', [ProductController::class, 'update'])->name('plants.update');
    Route::delete('/plants/{id}', [ProductController::class, 'destroy'])->name('plants.destroy');

    // Catalog routes
    // Route::get('/catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
    // Route::get('/catalogs/create', [CatalogController::class, 'create'])->name('catalogs.create');
    // Route::post('/catalogs', [CatalogController::class, 'store'])->name('catalogs.store');
    // Route::get('/catalogs/{id}', [CatalogController::class, 'show'])->name('catalogs.show');
    // Route::get('/catalogs/{id}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit');
    // Route::put('/catalogs/{id}', [CatalogController::class, 'update'])->name('catalogs.update');
    // Route::delete('/catalogs/{id}', [CatalogController::class, 'destroy'])->name('catalogs.destroy');

    Route::resource('catalogs', CatalogController::class);
    Route::resource('plants', ProductController::class);
});

// Shop route (public access to view plants)
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');