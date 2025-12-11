<?php

use Illuminate\Support\Facades\Route;
use Modules\Bar\Http\Controllers\BarController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::resource('bar', BarController::class)->names('bar');
    Route::get('bar/list', [BarController::class,'list'])->name('bar.list');
    Route::post('bar/select', [BarController::class,'select'])->name('bar.select');
});
