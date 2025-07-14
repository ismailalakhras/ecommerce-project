<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderAdminController;
use App\Http\Controllers\Backend\ProductAdminController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\frontend\CouponController as FrontendCouponController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ShoppingCartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



//! frontend Routes


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{id}/products', [ProductController::class, 'productsByCategoryId'])->name('category.products');

Route::get('/subcategory/{id}/products', [ProductController::class, 'productsBySubcategoryId'])->name('subcategory.products');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::middleware('auth:web')->group(function () {
    //! cart
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}', [ShoppingCartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [ShoppingCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [ShoppingCartController::class, 'destroy'])->name('cart.destroy');


    //! orders 
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    //! orders 
    Route::put('/coupon', [FrontendCouponController::class, 'update'])->name('coupon');
});



//! backend Routes

Route::middleware('auth:admin', 'role:admin')->group(function () {

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



    //!product
    Route::get('admin/product', [ProductAdminController::class, 'index'])->name('admin.product.index');
    Route::get('admin/product-create', [ProductAdminController::class, 'create'])->name('admin.product.create');
    Route::post('admin/product-store', [ProductAdminController::class, 'store'])->name('admin.product.store');

    Route::get('admin/product-edit/{product}', [ProductAdminController::class, 'edit'])->name('admin.product.edit');
    Route::put('admin/product-update/{product}', [ProductAdminController::class, 'update'])->name('admin.product.update');
    Route::delete('admin/product-delete/{product}', [ProductAdminController::class, 'destroy'])->name('admin.product.delete');

    //! order
    Route::get('admin/order', [OrderAdminController::class, 'index'])->name('admin.order.index');
    Route::get('admin/order-create', [OrderAdminController::class, 'create'])->name('admin.order.create');
    Route::post('admin/order-store', [OrderAdminController::class, 'store'])->name('admin.order.store');

    Route::get('admin/order-edit/{order}', [OrderAdminController::class, 'edit'])->name('admin.order.edit');
    Route::put('admin/order-update/{order}', [OrderAdminController::class, 'update'])->name('admin.order.update');
    Route::delete('admin/order-delete/{order}', [OrderAdminController::class, 'destroy'])->name('admin.order.delete');




    //! user
    Route::get('admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('admin/user-edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::delete('admin/user-delete/{user}', [UserController::class, 'destroy'])->name('admin.user.delete');


    //! coupon
    Route::get('admin/coupon', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::get('admin/coupon-create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('admin/coupon-store', [CouponController::class, 'store'])->name('admin.coupon.store');

    Route::get('admin/coupon-edit/{coupon}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::put('admin/coupon-update/{coupon}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::delete('admin/coupon-delete/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupon.delete');
});

//!----------------------------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
