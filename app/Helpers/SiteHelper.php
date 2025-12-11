<?php

if (!function_exists('format_price')) {
    function format_price($price)
    {
        return number_format($price, 2, ',', ' ') . ' €';
    }
}

if (!function_exists('format_short_price')) {
    function format_short_price($price)
    {
        return number_format($price, 0, ',', ' ') . ' €';
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return auth()->check() && auth()->user()->is_admin;
    }
}

if (!function_exists('get_current_user')) {
    function get_current_user()
    {
        return auth()->user();
    }
}
