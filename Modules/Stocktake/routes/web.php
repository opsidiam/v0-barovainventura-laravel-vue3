<?php

use Illuminate\Support\Facades\Route;
use Modules\Stocktake\Http\Controllers\ExportController;
use Modules\Stocktake\Http\Controllers\StocktakeController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::post('stocktake/users/search', [StocktakeController::class,'usersSearch'])->name('stocktake.users.search');
    Route::get('stocktake/{id}/process', [StocktakeController::class,'process'])->name('stocktake.process');
    Route::get('stocktake/live/check-data', [StocktakeController::class,'getLiveDataCheck'])->name('stocktake.data.check.update');
    Route::get('stocktake/live/get-data', [StocktakeController::class,'getLiveData'])->name('stocktake.data.update');
    Route::get('stocktake/live/check-state-data', [StocktakeController::class,'getLiveDataCheckState'])->name('stocktake.data.check.change.state');
    Route::get('stocktake/export/{id}/{type}', [ExportController::class,'export'])->name('stocktake.export');
    Route::get('stocktake/closed', [StocktakeController::class,'getCloseStocktakes'])->name('stocktake.closed');

    Route::post('stocktake/data/update/full-pack', [StocktakeController::class,'updateFullPack'])->name('stocktake.data.update.full-pack');
    Route::post('stocktake/data/update/weight', [StocktakeController::class,'updateWeight'])->name('stocktake.data.update.weight');
    Route::post('stocktake/data/delete/scan', [StocktakeController::class,'deleteScan'])->name('stocktake.data.delete.scan');
    Route::post('stocktake/data/close', [StocktakeController::class,'closeStocktake'])->name('stocktake.data.close');
    Route::post('stocktake/user/delete', [StocktakeController::class,'deleteUser'])->name('stocktake.user.delete');
    Route::resource('stocktake', StocktakeController::class)->names('stocktake');
});
