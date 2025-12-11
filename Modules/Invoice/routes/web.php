<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoice\Http\Controllers\InvoiceController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::resource('invoice', InvoiceController::class)->names('invoice');
});
