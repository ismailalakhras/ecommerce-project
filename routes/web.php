<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SubcategoryController;
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

Route::middleware('auth', 'role:admin')->group(function () {

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');







    //!category

    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('admin/category-create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category-store', [CategoryController::class, 'store'])->name('admin.category.store');

    Route::get('admin/category-edit/{category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('admin/category-update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category-delete/{category}', [CategoryController::class, 'destroy'])->name('admin.category.delete');


    //!subcategory

    Route::get('admin/subcategory', [SubcategoryController::class, 'index'])->name('admin.subcategory.index');
    Route::get('admin/subcategory-create', [SubcategoryController::class, 'create'])->name('admin.subcategory.create');
    Route::post('admin/subcategory-store', [SubcategoryController::class, 'store'])->name('admin.subcategory.store');

    Route::get('admin/subcategory-edit/{subcategory}', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    Route::put('admin/subcategory-update/{subcategory}', [SubcategoryController::class, 'update'])->name('admin.subcategory.update');
    Route::delete('admin/subcategory-delete/{subcategory}', [SubcategoryController::class, 'destroy'])->name('admin.subcategory.delete');
});

//!----------------------------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
