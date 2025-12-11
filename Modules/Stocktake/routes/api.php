<?php

use Illuminate\Support\Facades\Route;
use Modules\Stocktake\Http\Controllers\StocktakeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stocktake', StocktakeController::class)->names('stocktake');
});
