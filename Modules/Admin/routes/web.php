<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminDataTableController;
use Modules\Admin\Http\Controllers\AdminPartnerController;
use Modules\Admin\Http\Controllers\AdminPotentialCustomerController;
use Modules\Admin\Http\Controllers\AdminUserController;
use Modules\Admin\Http\Controllers\AdminUserPartnerController;
use Modules\Admin\Http\Controllers\ApprovedProductsController;
use Modules\Admin\Http\Controllers\AuditLogsController;
use Modules\Admin\Http\Controllers\LeadsController;
use Modules\Admin\Http\Controllers\SmsController;
use Modules\Admin\Http\Controllers\SupportController;
use Modules\Admin\Http\Controllers\UnapprovedProductsController;

Route::middleware(['auth', 'verified'])->prefix('/admin')->group(function () {
    Route::resource('dashboard', AdminController::class)->names('admin.dashboard');

    /*
                |--------------------------------------------------------------------------
                | Approved product routes
                |--------------------------------------------------------------------------
                |*/

    // Approved products resource
    Route::resource('approved-products', ApprovedProductsController::class,["as"=>"admin"]);
    Route::get('approved-products/{id}/hide', [ApprovedProductsController::class, 'hide'])->name('admin.approved-products.hide');
    Route::get('data-table/approved-products', [AdminDataTableController::class, 'approvedProducts'])->name('admin.data-table.approved-products');


    /*
    |--------------------------------------------------------------------------
    | Unapproved products routes
    |--------------------------------------------------------------------------
    |*/

    // Unapproved products resource
    Route::resource('unapproved-products', UnapprovedProductsController::class,["as"=>"admin"]);
    Route::get('unapproved-products/{cargo}/unhide', [UnapprovedProductsController::class, 'unhide'])->name('admin.unapproved-products.unhide');
    Route::get('data-table/unapproved-products', [AdminDataTableController::class, 'unapprovedProducts'])->name('admin.data-table.unapproved-products');


    /*
    |--------------------------------------------------------------------------
    | Supports routes
    |--------------------------------------------------------------------------
    |*/

    // Supports resource
    Route::resource('support', SupportController::class,["as"=>"admin"]);
    Route::get('data-table/support', [AdminDataTableController::class, 'support'])->name('admin.data-table.support');
    Route::get('support/done/{id}', [SupportController::class, 'done'])->name('admin.support.done');

    /*
    |--------------------------------------------------------------------------
    | Users routes
    |--------------------------------------------------------------------------
    |*/

    // Users resource
    Route::resource('users', AdminUserController::class,["as"=>"admin"]);
    Route::get('data-table/users', [AdminDataTableController::class, 'users'])->name('admin.data-table.users');
    Route::post('users/assign/licence', [AdminUserController::class, 'assignLicence'])->name('admin.users.assign.licence');
    Route::post('users/reset/licence/{id}', [AdminUserController::class, 'resetLicence'])->name('admin.users.reset.licence');
    Route::post('users/{user}/files', [AdminUserController::class, 'storeFile'])->name('admin.users.files.store');
    Route::get('users/{user}/files/{file}/download', [AdminUserController::class, 'downloadFile'])->name('admin.users.files.download');
    Route::delete('users/{user}/files/{file}', [AdminUserController::class, 'destroyFile'])->name('admin.users.files.destroy');
    Route::get ('users/{user}/contracts/simple', [AdminUserController::class, 'createContracts'])->name('users.contracts.simple.create');
    Route::post('users/{user}/contracts/simple', [AdminUserController::class, 'storeContracts' ])->name('users.contracts.simple.store');
    Route::post('users/{user}/device-loan',            [AdminUserController::class, 'storeDeviceLoan'])->name('admin.users.device_loan.store');
    Route::post('users/{user}/device-loan/purchased',  [AdminUserController::class, 'markDeviceLoanPurchased'])->name('admin.users.device_loan.purchased');
    Route::post('users/{user}/device-loan/returned',   [AdminUserController::class, 'markDeviceLoanReturned'])->name('admin.users.device_loan.returned');
    Route::post('users/{user}/device-loan/contract',   [AdminUserController::class, 'deviceLoanContract'])->name('admin.users.device_loan.contract');
    Route::post('notes',        [AdminUserController::class, 'storeNote'])->name('admin.notes.store');
    Route::delete('notes/{note}', [AdminUserController::class, 'destroyNote'])->name('admin.notes.destroy');
    Route::post('users/{user}/postal-package/sheet/create', [AdminUserController::class, 'createPostalSheet' ])->name('users.postal-package.sheet.create');

    /*
    |--------------------------------------------------------------------------
    | Partners routes
    |--------------------------------------------------------------------------
    |*/

    // Users resource
    Route::resource('partners', AdminPartnerController::class, ["as"=>"admin"]);
    Route::get('data-table/partners', [AdminDataTableController::class, 'partners'])->name('admin.data-table.partners');
    Route::post('users/{user}/assign-partner', [AdminUserPartnerController::class, 'store'])->name('admin.users.assign-partner');
    Route::delete('users/{user}/unassign-partner', [AdminUserPartnerController::class, 'destroy'])->name('admin.users.unassign-partner');
    Route::post('partners/commissions/{commission}/pay', [AdminUserPartnerController::class, 'pay'])->name('admin.partners.commissions.pay');
    Route::patch('partners/{partner}/clients/{user}/payout', [AdminUserPartnerController::class, 'markClientPayout'])
        ->name('admin.partners.clients.payout');
    /*
    |--------------------------------------------------------------------------
    | Potential customers routes
    |--------------------------------------------------------------------------
    |*/

    // Users resource
    Route::resource('potential-customers', AdminPotentialCustomerController::class, ["as"=>"admin"]);
    Route::get('data-table/potential-customers', [AdminDataTableController::class, 'potentialCustomers'])->name('admin.data-table.potential-customers');
    Route::post('potential-customers/quick-update', [AdminDataTableController::class, 'potentialCustomers'])->name('admin.potential-customers.quick_update');



    /*
    |--------------------------------------------------------------------------
    | SMS routes
    |--------------------------------------------------------------------------
    |*/

    // sms resource
    Route::resource('sms', SmsController::class,["as"=>"admin"]);
    Route::get('data-table/sms', [AdminDataTableController::class, 'sms'])->name('admin.data-table.sms');
    Route::get('sms/resend/{id}', [SmsController::class, 'resendSms'])->name('admin.sms.resend');


    /*
    |--------------------------------------------------------------------------
    | Leads routes
    |--------------------------------------------------------------------------
    |*/

    // sms resource
    Route::resource('leads', LeadsController::class,["as"=>"admin"]);
    Route::get('data-table/leads', [AdminDataTableController::class, 'leads'])->name('admin.data-table.leads');
    Route::get('leads/resend/{id}', [LeadsController::class, 'resendLeads'])->name('admin.leads.resend');






    Route::get('data-table/newsletter', [AdminDataTableController::class, 'newsletter'])->name('admin.data-table.newsletter');


    /*
    |--------------------------------------------------------------------------
    | E-Mail routes
    |--------------------------------------------------------------------------
    |*/

    // E-Mail resource
//            Route::resource('email', EmailController::class,["as"=>"admin"]);



    /*
    |--------------------------------------------------------------------------
    | Audit logs routes
    |--------------------------------------------------------------------------
    |*/

    // Audit logs resource
    Route::resource('auditlogs', AuditLogsController::class,["as"=>"admin"]);
    Route::get('data-table/auditlogs', [AdminDataTableController::class, 'auditLogs'])->name('admin.data-table.auditLogs');
    Route::get('data-table/auditlogs/{id}/popover', [AdminDataTableController::class, 'auditLogPopover'])->name('admin.data-table.auditLogPopover');
    Route::get('data-table/auditlogs/{id}/error-trace', [AdminDataTableController::class, 'auditLogErrorTrace'])->name('admin.data-table.auditLogErrorTrace');

//    /*
//    |--------------------------------------------------------------------------
//    | Labels routes
//    |--------------------------------------------------------------------------
//    |*/
//
//    // Labels resource
//    Route::resource('labels', LabelsController::class,["as"=>"admin"]);
//    Route::post('labels/ean/add', [LabelsController::class, 'getItemsEanAdd'])->name('admin.labels.ean.add');
//    Route::post('labels/logo/create', [LabelsController::class, 'getItemsLogoCreate'])->name('admin.labels.logo.create');
//    Route::post('labels/30day/free/1', [LabelsController::class, 'getItems30datFree'])->name('admin.labels.30day.free');
//    Route::post('labels/30day/free/2', [LabelsController::class, 'getItems30datFree2'])->name('admin.labels.30day.free2');
//    Route::post('labels/qr/add', [LabelsController::class, 'getItemsQrAdd'])->name('admin.labels.qr.add');
//    Route::post('labels/add', [AdminController::class, 'postItemsAdd'])->name('admin.labels.add');
//    Route::get('labels/detail', [AdminController::class, 'getItemsDetail'])->name('admin.labels.detail');

});
