<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::prefix('/app')->group(function () {
    Route::get('user/verify/email/{token}', [UserController::class, 'emailVerifyToken'])->name('user.verify.email');
    Route::get('user/verify/invoice/email/{token}', [UserController::class, 'emailInvoiceVerifyToken'])->name('user.verify.invoice');
});
Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::post('user/code/use', [UserController::class,'postCode'])->name('user.code.post');
    Route::post('user/code/use', [UserController::class,'postCode'])->name('user.code.post');
    Route::get('user/login-history', [UserController::class,'getLoginHistory'])->name('user.login-history');
    Route::get('user/order-history', [UserController::class,'getOrderHistory'])->name('user.order-history');

    Route::resource('user', UserController::class)->names('user');
});
