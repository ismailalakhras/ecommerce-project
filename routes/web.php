<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShoppingCartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



//! frontend Routes


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{id}/products', [ProductController::class, 'productsByCategoryId'])->name('category.products');

Route::get('/subcategory/{id}/products', [ProductController::class, 'productsBySubcategoryId'])->name('subcategory.products');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [ShoppingCartController::class, 'store'])->name('cart.add');
    Route::put('/cart/update/{product}', [ShoppingCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [ShoppingCartController::class, 'destroy'])->name('cart.remove');
});


//! backend Routes

Route::middleware('auth','role:admin')->group(function () {
    
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


});

//!----------------------------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
