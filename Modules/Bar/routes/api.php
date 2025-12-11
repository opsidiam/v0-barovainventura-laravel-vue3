<?php

use Illuminate\Support\Facades\Route;
use Modules\Bar\Http\Controllers\BarController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bar', BarController::class)->names('bar');
});
