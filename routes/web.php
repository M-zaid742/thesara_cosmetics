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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;

// ==================== HOME ====================
Route::get('/', fn() => view('welcome'));

// ==================== SHOP ====================
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/products/category/{category}', [ProductController::class, 'index'])->name('products.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/show', [ProductController::class, 'index'])->name('products.index');

// ==================== CART ====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');

// ==================== WISHLIST ====================
Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');

// ==================== CHECKOUT ====================
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

// ==================== TRACK ORDER ====================
Route::get('/track-order', [TrackController::class, 'showForm'])->name('track.order');
Route::get('/track-order/result', [TrackController::class, 'search'])->name('track.result');

// ==================== ABOUT & FAQ ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// ==================== AUTH ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ==================== USER PROFILE & ORDERS ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

// ==================== ADMIN ====================
Route::prefix('admin')->group(function () {

    // Admin Login
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Admin Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->middleware('auth:admin')
        ->name('admin.dashboard');

    // Admin Logout
    Route::get('/logout', function () {
        return view('admin.logout');
    })->name('admin.logout.page');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Forgot Password
    Route::get('forgot-password', fn() => view('admin.forgot-password'))->name('admin.forgot.password');

    // Update Password
    Route::get('password', fn() => view('admin.updatepassword'))
        ->middleware('auth:admin')
        ->name('admin.password.form');
    Route::post('password/update', [AdminAuthController::class, 'updatePassword'])
        ->middleware('auth:admin')
        ->name('admin.password.update');

    // Admin Profile
    Route::get('profile', [AdminAuthController::class, 'profile'])
        ->middleware('auth:admin')
        ->name('admin.profile');
    Route::post('profile/update', [AdminAuthController::class, 'updateProfile'])
        ->middleware('auth:admin')
        ->name('admin.profile.update');
});