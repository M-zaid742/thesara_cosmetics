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
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DermAI\ProgressController as DermAIProgressController;
use App\Http\Controllers\DermAI\ChatController as DermAIChatController;
use App\Http\Controllers\DermAI\SkinController as DermAISkinController;
use App\Models\Notification;
use App\Models\Contact;

// ==================== HOME ====================
Route::get('/', [PageController::class, 'home']);

// ==================== SHOP ====================
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/products/category/{category}', [ProductController::class, 'category'])->name('products.category');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// ==================== CART ====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// ==================== WISHLIST ====================
Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');

// ==================== AUTH ====================
// Note: Auth::routes() registers /login, /register, /logout, /password/* automatically
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

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
    Route::get('/orders/cancel', [SupportController::class, 'showCancelForm'])->name('orders.cancel.form');
    Route::post('/orders/cancel', [SupportController::class, 'submitCancel'])->name('orders.cancel.submit');

    // Feedback
    Route::get('/feedback', [SupportController::class, 'showFeedbackForm'])->name('feedback.form');
    Route::post('/feedback', [SupportController::class, 'submitFeedback'])->name('feedback.submit');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ==================== DERMAI ROUTES ====================
Route::middleware(['auth'])->prefix('dermai')->group(function () {
    Route::get('/chat', [DermAIChatController::class, 'index'])->name('dermai.chat');
    Route::post('/chat/send', [DermAIChatController::class, 'sendMessage'])->name('dermai.chat.message');
    Route::get('/chat/history', [DermAIChatController::class, 'getHistory'])->name('dermai.chat.history');
    Route::post('/analyze-skin', [DermAISkinController::class, 'analyzeImage'])->name('dermai.analyze');

    Route::get('/progress', [DermAIProgressController::class, 'index'])->name('dermai.progress');
    Route::post('/progress', [DermAIProgressController::class, 'store'])->name('dermai.progress.log');
});

// ==================== TRACK ORDER (PUBLIC) ====================
Route::get('/track-order', [TrackController::class, 'showForm'])->name('track.order');
Route::get('/track-order/result', [TrackController::class, 'search'])->name('track.result');

// ==================== ABOUT & FAQ ====================
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// ==================== ADMIN ====================
Route::prefix('admin')->middleware('localhost.only')->group(function () {

    // ================= ADMIN LOGIN =================
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // ================= PROTECTED ADMIN ROUTES =================
    Route::middleware('auth:admin')->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // ================= PRODUCTS =================
        Route::get('products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

        // ================= CATEGORIES =================
        Route::get('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('categories/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('categories/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // ================= ORDERS =================
        Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('orders/pending', [AdminOrderController::class, 'pending'])->name('admin.orders.pending');
        Route::get('orders/completed', [AdminOrderController::class, 'completed'])->name('admin.orders.completed');
        Route::get('orders/cancelled', [AdminOrderController::class, 'cancelled'])->name('admin.orders.cancelled');
        Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::get('orders/{id}/invoice', [AdminOrderController::class, 'invoice'])->name('admin.orders.invoice');
        Route::put('orders/{id}/status', [AdminOrderController::class, 'status'])->name('admin.orders.status');

        // Messages
        Route::get('messages', [AdminAuthController::class, 'messages'])->name('admin.messages');

        // Notifications
        Route::get('notifications', [AdminAuthController::class, 'notifications'])->name('admin.notifications');

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