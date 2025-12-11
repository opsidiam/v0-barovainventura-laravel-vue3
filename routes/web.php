<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return redirect()->route('home');
})->name('index');
// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('recaptcha');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('recaptcha');

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Statické stránky (dostupné pre všetkých)
Route::controller(HomeController::class)->group(function () {
    Route::get('/domov', 'index')->name('home');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/kontakt', 'contact')->name('contact');
    Route::get('/cennik', 'pricelist')->name('pricelist');
    Route::get('/gdpr', 'gdpr')->name('gdpr');
    Route::get('/vop', 'vop')->name('vop');
    Route::get('/o-nas', 'about')->name('about');
    Route::get('/navody', 'tutorial')->name('tutorial');
    Route::get('/tutorial', 'tutorial')->name('tutorial');
    Route::get('/stiahnut', 'download')->name('download');
    Route::get('/captcha', 'captcha')->name('captcha');
    Route::post('/request-quote', 'requestQuote')->name('request.quote')->middleware('recaptcha');
    Route::post('/newsletter-subscribe', 'newsletterSubscribe')->name('newsletter.subscribe')->middleware('recaptcha');
    Route::post('/contact-send', 'contactForm')->name('contact.send')->middleware('recaptcha');

});

// Support routes
Route::controller(SupportController::class)->group(function () {
    Route::get('/support/contact/form', 'supportContactForm')->name('support.contact.form');
    Route::get('/support', 'supportContactForm')->name('support');
    Route::post('/support/contact/form/post', 'supportContactFormPost')->name('support.contact.submit')->middleware('recaptcha');
});

// Support routes
Route::controller(ContractController::class)->group(function () {
    Route::get('/contract/request/{hash}', 'requestContract')->name('request-contract');
    Route::get('/contract/create/{hash}', 'contract')->name('contract');
    Route::get('/contract/download/{hash}', 'contractDownload')->name('contract.download');
    Route::post('/contract/contact/form/post', 'contractFormPost')->name('contract.contact.submit')->middleware('recaptcha');
    Route::post('/contract/upload/form/post', 'contractUploadFormPost')->name('contract.upload.submit')->middleware('recaptcha');
});

// Chránené routes (pre prihlásených)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/check/session', [AppController::class, 'getCheckSession'])->name('check.session');
});

Route::get('/session-check', function() {
    return response()->json([
        'active' => auth()->check(),
        'remaining' => now()->diffInSeconds(session()->get('last_activity'))
    ]);
})->name('session-check');

Route::get('/generate-ean-feed', function () {
    Artisan::call('app:generate-ean-xml-feed');
    return response()->json([
        'status' => 'ok',
        'message' => 'Feed bol vygenerovaný.',
    ]);
});

Route::get('/ean-feed', function () {
    $path = public_path('ean-feed.xml');

    if (!file_exists($path)) {
        abort(404, 'Feed ešte nebol vygenerovaný.');
    }

    return response()->file($path, [
        'Content-Type' => 'application/xml; charset=UTF-8'
    ]);
});

Route::get('/sms/temperature/{id}/{data}', function () {
    return true;
});
