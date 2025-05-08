<?php
// Lyra Attallah Aurellia_F55123014
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;

Route::resource('catalogs', CatalogController::class);

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/plants', [ProductController::class, 'index'])->name('plants.index');
Route::get('/plants/create', [ProductController::class, 'create'])->name('plants.create');
Route::post('/plants', [ProductController::class, 'store'])->name('plants.store');
Route::get('/plants/{id}', [ProductController::class, 'show'])->name('plants.show');
Route::get('/plants/{id}/edit', [ProductController::class, 'edit'])->name('plants.edit');
Route::put('/plants/{id}', [ProductController::class, 'update'])->name('plants.update');
Route::delete('/plants/{id}', [ProductController::class, 'destroy'])->name('plants.destroy');

Route::resource('plants', ProductController::class);

