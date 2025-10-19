<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkinAnalysisController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserControllerAuth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// 👇 NEW SHOP PAGE ROUTE (publicly accessible)
Route::get('/shop', function () {
    return view('shop.shop');
})->name('shop');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ------------------ AUTHENTICATED USER ROUTES ------------------ //
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


// ------------------ ADMIN ROUTES ------------------ //
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('admin.products');
    Route::post('/products/add', [AdminController::class, 'addProduct'])->name('admin.products.add');

    // Edit product form
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');

    // Update product (PUT/PATCH)
    Route::match(['put', 'patch'], '/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');

    // Delete product
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});


Route::get('/products/cleanser', function () {
    return view('products.cleanser');
})->name('products.cleanser');

Route::get('/products/serum', function () {
    return view('products.serum');
})->name('products.serum');

Route::get('/products/moisturizer', function () {
    return view('products.moisturizer');
})->name('products.moisturizer');

Route::get('/products/sunscreen', function () {
    return view('products.sunscreen');
})->name('products.sunscreen');

Route::get('/products/exfoliator', function () {
    return view('products.exfoliator');
})->name('products.exfoliator');