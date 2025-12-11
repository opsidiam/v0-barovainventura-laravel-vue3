<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\SettingController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::resource('setting', SettingController::class)->names('setting');
    Route::post('setting/update/email', [SettingController::class,'postUpdateEmail'])->name('setting.update.email');
    Route::post('setting/update/invoice', [SettingController::class,'postUpdateInvoice'])->name('setting.update.invoice');
});
