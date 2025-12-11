<?php

use Illuminate\Support\Facades\Route;
use Modules\Item\Http\Controllers\ItemController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('item/value/update', [ItemController::class,'valueUpdate'])->name('item.value.add');
    Route::post('item/supplier/update', [ItemController::class,'supplierUpdate'])->name('item.supplier.update');
    Route::prefix('/app')->group(function () {
        Route::resource('item', ItemController::class)->names('item');
    });
});
