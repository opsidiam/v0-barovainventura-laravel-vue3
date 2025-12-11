<?php

use Illuminate\Support\Facades\Route;
use Modules\License\Http\Controllers\LicenseController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('license', LicenseController::class)->names('license');
});
