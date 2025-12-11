<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::get('product/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('product.add-to-cart');
    Route::get('product/cart', [ProductController::class, 'cart'])->name('product.cart');
    Route::post('product/checkout', [ProductController::class, 'checkout'])->name('product.checkout');
    Route::get('product/order/{order_id}/checkout', [ProductController::class,'orderCheckout'])->name('product.order.checkout');
    Route::post('product/remove-to-cart', [ProductController::class, 'removeToCart'])->name('product.remove-to-cart');
    Route::resource('product', ProductController::class)->names('product');
});
