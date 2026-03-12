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
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Notification;
use App\Models\Contact;

// ==================== HOME ====================
Route::get('/', [PageController::class, 'home']);

// ==================== SHOP ====================
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/products/category/{category}', [ProductController::class, 'index'])->name('products.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/show', [ProductController::class, 'index'])->name('products.index');

// ==================== CART ====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// ==================== WISHLIST ====================
Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');

// ==================== AUTH ====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware('auth')->group(function () {

    // Buy Now
    Route::post('/buy-now', [ProductController::class, 'buyNow'])->name('buy.now');

    // Checkout
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');

    // Orders
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ==================== TRACK ORDER (PUBLIC) ====================
Route::get('/track-order', [TrackController::class, 'showForm'])->name('track.order');
Route::get('/track-order/result', [TrackController::class, 'search'])->name('track.result');

// ==================== ABOUT & FAQ ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// ==================== ADMIN ====================
Route::prefix('admin')->group(function () {

    // ================= ADMIN LOGIN =================
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // ================= PROTECTED ADMIN ROUTES =================
    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Orders
        // Orders
Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/pending', [AdminOrderController::class, 'pending'])->name('admin.orders.pending');
Route::get('orders/completed', [AdminOrderController::class, 'completed'])->name('admin.orders.completed');
Route::get('orders/cancelled', [AdminOrderController::class, 'cancelled'])->name('admin.orders.cancelled');
Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::get('orders/{id}/invoice', [AdminOrderController::class, 'invoice'])->name('admin.orders.invoice');
Route::put('orders/{id}/status', [AdminOrderController::class, 'status'])->name('admin.orders.status');
        // Messages
        Route::get('messages', [AdminAuthController::class,'messages'])->name('admin.messages');

        // Notifications
        Route::get('notifications', [AdminAuthController::class,'notifications'])->name('admin.notifications');

        // Profile
        Route::get('profile', [AdminAuthController::class, 'profile'])->name('admin.profile');
        Route::post('profile/update', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');

        // Password
        Route::get('password', fn() => view('admin.updatepassword'))->name('admin.password.form');
        Route::post('password/update', [AdminAuthController::class, 'updatePassword'])->name('admin.password.update');

        // Logout
        Route::get('logout', fn() => view('admin.logout'))->name('admin.logout.page');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    });

});