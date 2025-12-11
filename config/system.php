<?php

return [

    'invoice_email' => env('INVOICE_EMAIL',''),
    'invoice_password' => env('INVOICE_PASSWORD',''),
    'payment_token' => env('PAYMENT_TOKEN',''),

    /*
    |--------------------------------------------------------------------------
    | Admin pagination
    |--------------------------------------------------------------------------
	|
	| Default admin pagination setting.
	|
    */

    'paginate' => 50,


    /*
    |--------------------------------------------------------------------------
    | Date format for php
    |--------------------------------------------------------------------------
	|
	| Set default date format in php files.
	|
    */

    'date_format' => 'd.m.Y',

    /*
    |--------------------------------------------------------------------------
    | Date and time format for php
    |--------------------------------------------------------------------------
	|
	| Set default datetime format in php files.
	|
    */

    'datetime_format' => 'd.m.Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Date format for datepicker
    |--------------------------------------------------------------------------
	|
	| Set default date format in js datepicker.
	|
    */

    'datepicker_date_format' => 'dd.mm.yyyy',

    /*
    |--------------------------------------------------------------------------
    | Time format for php
    |--------------------------------------------------------------------------
    |
    | Set default date format in php files.
    |
    */

    'time_format' => 'H:i',

    /*
    |--------------------------------------------------------------------------
    | Time format for datepicker
    |--------------------------------------------------------------------------
	|
	| Set default time format in js datepicker.
	|
    */

    'datepicker_time_format' => 'H:i',

    /*
    |--------------------------------------------------------------------------
    | Time format placeholder for datepicker
    |--------------------------------------------------------------------------
	|
	| Set default time format placeholder in js datepicker.
	|
    */

    'datepicker_time_placeholder' => 'hh:mm',

    /*
    |--------------------------------------------------------------------------
    | Week start for datepicker
    |--------------------------------------------------------------------------
	|
	| Set default start of week in js datepicker.
	|
    */

    'datepicker_week_start' => 1,

    /*
    |--------------------------------------------------------------------------
    | Datepicker language
    |--------------------------------------------------------------------------
	|
	| Set default language in js datepicker.
	|
    */
    'datepicker_language' => 'sk',
    ];
