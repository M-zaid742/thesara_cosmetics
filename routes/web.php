<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
// ==================== about us / faq  / CHECK OUT====================
Route::get('/about', [AboutController::class, 'index'])->name('about');
use App\Http\Controllers\PageController;

Route::get('/faq', [PageController::class, 'faq']);

Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

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
    // Show login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // Handle login form submission
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Dashboard (GET only)
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
});