<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkinAnalysisController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public landing + shop
Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', function () {
    return view('shop.shop');
})->name('shop');

// Auth scaffolding (Laravel UI / Breeze / Jetstream, whichever you use)
Auth::routes();

// Home (after login)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ---------- PUBLIC PRODUCT ROUTES ----------
/**
 * ✅ Dynamic product detail page: /product/1, /product/2, ...
 * This calls ProductController@show and renders resources/views/products/show.blade.php
 */
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->whereNumber('id')
    ->name('product.show');

// ---------- AUTHENTICATED USER ROUTES ----------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/skin/upload', [SkinAnalysisController::class, 'upload'])->name('skin.upload');
    Route::post('/chatbot', [ChatbotController::class, 'chat'])->name('chatbot.chat');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/wishlist/add', [ProductController::class, 'addToWishlist'])->name('wishlist.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/track', [OrderController::class, 'track'])->name('orders.track');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});

// ---------- ADMIN ROUTES ----------
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('admin.products');
    Route::post('/products/add', [AdminController::class, 'addProduct'])->name('admin.products.add');

    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::match(['put', 'patch'], '/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});

// (Optional) Static demo views you already had
Route::get('/products/cleanser', fn () => view('products.cleanser'))->name('products.cleanser');
Route::get('/products/serum', fn () => view('products.serum'))->name('products.serum');
Route::get('/products/moisturizer', fn () => view('products.moisturizer'))->name('products.moisturizer');
Route::get('/products/sunscreen', fn () => view('products.sunscreen'))->name('products.sunscreen');
Route::get('/products/exfoliator', fn () => view('products.exfoliator'))->name('products.exfoliator');