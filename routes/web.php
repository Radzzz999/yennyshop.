<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
//use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin; // ⬅️ Import middleware
use App\Http\Controllers\PaymentController;

// Landing Page
Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

// Dashboard (bisa dipakai untuk customer atau umum)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Keranjang
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');


     // Halaman pembayaran
    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.page');
    Route::get('/payment', [CartController::class, 'showPayment'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');


    // Checkout
   // Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    //Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Dashboard (lama - masih dibiarkan)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'is_admin'])
    ->name('admin.dashboard');

//  Admin Dashboard & CRUD Produk khusus admin
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Produk CRUD
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Tempatkan show paling akhir
    Route::get('/products/{product}', [AdminController::class, 'showProduct'])->name('products.show');

    // Laporan pembayaran
    Route::get('/payments', [AdminController::class, 'paymentReport'])->name('payments.report');
});



require __DIR__.'/auth.php';
