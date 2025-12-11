<?php

use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\NotificationController;

Route::group(['middleware' => 'auth'], function() {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function() {
    Route::resource('notifications', NotificationController::class)->except(['show', 'edit', 'update', 'destroy']);
});
