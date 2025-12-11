<?php

use Illuminate\Support\Facades\Route;
use Modules\Cargo\Http\Controllers\CargoController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('cargo/supplier/update', [CargoController::class,'supplierUpdate'])->name('cargo.supplier.update');
    Route::post('cargo/live-data/search', [CargoController::class,'searchCargo'])->name('cargo.live-data.search');
    Route::resource('cargo', CargoController::class)->names('cargo');
});
