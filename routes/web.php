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
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Protected dashboard
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])
        ->name('admin.dashboard')
        ->middleware('auth:admin');
          Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('logout', function () {
        return view('admin.logout');
    })->middleware('auth:admin');

    Route::get('forgot-password', function () {
    return view('admin.forgot-password');
})->name('admin.password.form');

    Route::get('password', function() {
    return view('admin.updatepassword');
})->middleware('auth:admin')->name('admin.password.form');

Route::post('password/update', [AdminAuthController::class, 'updatePassword'])
    ->middleware('auth:admin')
    ->name('admin.password.update');


});


