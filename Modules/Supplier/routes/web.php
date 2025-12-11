<?php

use Illuminate\Support\Facades\Route;
use Modules\Supplier\Http\Controllers\SupplierController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::post('supplier/live-data/search', [SupplierController::class,'searchSupplier'])->name('supplier.live-data.search');
    Route::resource('supplier', SupplierController::class)->names('supplier');
    Route::get('tutorial', [SupplierController::class, 'tutorial'])->name('tutorial.index');
});
