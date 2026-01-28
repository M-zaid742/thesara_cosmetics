<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;


// ==================== about us  ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


// ==================== about us / faq  / CHECK OUT====================


Route::get('/faq', [PageController::class, 'faq']);
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

// ==================== wishlist====================



Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');

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


Route::prefix('admin')->group(function () {

    // Admin Login
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Dashboard
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])
        ->middleware('auth:admin')
        ->name('admin.dashboard');

    // Logout
    // Show logout confirmation page (GET)
  // Logout confirmation page (GET)  ✅ FIXES 404
    Route::get('/logout', function () {
        return view('admin.logout');
    })->name('admin.logout.page');

    // Actual logout action (POST)
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');

    // Forgot Password
    Route::get('forgot-password', fn() => view('admin.forgot-password'))->name('admin.forgot.password');

    // Update Password (logged in)
    Route::get('password', fn() => view('admin.updatepassword'))->middleware('auth:admin')->name('admin.password.form');
    Route::post('password/update', [AdminAuthController::class, 'updatePassword'])->middleware('auth:admin')->name('admin.password.update');

    // ✅ ADMIN PROFILE
    Route::get('profile', [AdminAuthController::class, 'profile'])->middleware('auth:admin')->name('admin.profile');
    Route::post('profile/update', [AdminAuthController::class, 'updateProfile'])->middleware('auth:admin')->name('admin.profile.update');

});
