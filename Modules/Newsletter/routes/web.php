<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\Http\Controllers\NewsletterController;

Route::middleware(['auth', 'verified'])->prefix('/app')->group(function () {
    Route::resource('newsletter', NewsletterController::class)->names('newsletter');
    Route::get('newsletter/show/{id}', [NewsletterController::class,'showNewsletter'])->name('newsletter.preview');
    Route::post('newsletter/allow/send/{id}', [NewsletterController::class,'allowSendNewsletter'])->name('newsletter.allow.send');

});
