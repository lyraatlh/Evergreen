<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\UserCatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserShopController;
use Illuminate\Support\Facades\Auth;

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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
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

    Route::resource('catalogs', CatalogController::class);
    Route::resource('plants', ProductController::class);
});

// User
Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [HomeController::class, "index"])->name('home');

    // Profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    // Catalog
    Route::get('/catalog', [UserCatalogController::class, 'index'])->name('catalog');
    Route::get('/catalog/{typeId}', [UserCatalogController::class, 'show'])->name('catalog.show');
    
    // Shop
    Route::get('/shop', [UserShopController::class, 'index'])->name('shop');
    Route::post('/cart/add', [UserShopController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [UserShopController::class, 'viewCart'])->name('cart');
    Route::post('/cart/update', [UserShopController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/remove/{plantId}', [UserShopController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [UserShopController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [UserShopController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order/success', [UserShopController::class, 'orderSuccess'])->name('order.success');
});

// Redirect untuk backward compatibility
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/profile', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.profile.index');
        } else {
            return redirect()->route('user.profile.index');
        }
    });
    Route::get('/home', function () {
        return redirect()->route('user.home');
    });
    Route::get('/profile', function () {
        return redirect()->route('user.profile.index');
    });
});

// Public routes (accessible without login)
Route::get('/home', function () {
    return view('user.home');
})->name('home');

Route::get('/catalog', [UserCatalogController::class, 'index'])->name('catalogs.index');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');