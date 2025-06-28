<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShoppingCartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;










// Route::get('/cart', [ShoppingCartController::class, 'index'])->middleware(['auth', 'role:admin'])->name('cart');











Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/category/{id}/products', [ProductController::class, 'productsByCategoryId'])->name('category.products');

Route::get('/subcategory/{id}/products', [ProductController::class, 'productsBySubcategoryId'])->name('subcategory.products');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');





Route::get('/admin/dashboard', function () {
    return view('backend.layout.master');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');










Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [ShoppingCartController::class, 'store'])->name('cart.add');
    Route::put('/cart/update/{product}', [ShoppingCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [ShoppingCartController::class, 'destroy'])->name('cart.remove');
});

require __DIR__ . '/auth.php';
