<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackController;

// ==================== PUBLIC ROUTES (NO LOGIN) ====================
Route::get('/', fn() => view('welcome'));
Route::get('/shop', fn() => view('shop.index'))->name('shop');

// Products (public)
Route::get('/show', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Track Order (public - working already)
Route::get('/track-order', [TrackController::class, 'showForm'])->name('track.order');
Route::get('/track-order/result', [TrackController::class, 'search'])->name('track.result');

// Auth routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ==================== PROTECTED ROUTES (LOGIN REQUIRED) ====================
Route::middleware('auth')->group(function () {

    // Cart (only logged-in users)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    
    // Add to cart & wishlist (POST - login required)
    Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/wishlist/add', [ProductController::class, 'addToWishlist'])->name('wishlist.add');

    // Checkout
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // My Orders (only logged-in users)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile, etc.
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});