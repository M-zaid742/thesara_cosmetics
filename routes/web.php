<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
// ==================== about us  ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// ==================== PUBLIC ROUTES ====================
Route::get('/', fn() => view('welcome'));
Route::get('/shop', fn() => view('shop.shop'))->name('shop');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Products (public)
Route::get('/show', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Track Order (public - working already)
Route::get('/track-order', [TrackController::class, 'showForm'])->name('track.order');
Route::get('/track-order/result', [TrackController::class, 'search'])->name('track.result');

// Auth routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 // ================= ADMIN AUTH ROUTES =================
// Route::get('/admin/login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
// Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// // ================= ADMIN PROTECTED ROUTES =================
// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
// });

Route::prefix('admin')->group(function () {

    // Admin login page
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login');

    // Admin login submit
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');

    // Admin dashboard
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])
        ->name('admin.dashboard');
});
