<?php

use Illuminate\Support\Facades\Route;
use Modules\License\Http\Controllers\LicenseController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::post('license/select', [LicenseController::class,'select'])->name('license.select');
    Route::get('license/select/{order_id}', [LicenseController::class,'selectShow'])->name('license.select.show');
    Route::post('license/checkout', [LicenseController::class,'checkout'])->name('license.checkout');
    Route::get('license/order/{order_id}/checkout', [LicenseController::class,'orderCheckout'])->name('license.order.checkout');
    Route::resource('license', LicenseController::class)->names('license');
});
