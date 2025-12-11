<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBarSelected
{

    protected $except = [
        'welcome*',
        'domov*',
        '/',
        'about*',
        'contract*',
        'navody*',
        'tutorial*',
        'faq*',
        'stiahnut*',
        'gdpr*',
        'vop*',
        'support*',
        'cennik*',
        'kontakt*',
        'ean-feed*',
        'app/bar*',
        'admin*',
        'user-files*',
        'captcha*',
        'app/product*',
        'app/license*',
        'login*',
        'register*',
        'logout*',
        'app/user*',
        'app/setting*',
        'session-check*',
        'notifications*',
        'app/newsletter*',
        'app/tutorial*',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest() || $request->routeIs('bar.select') || $request->routeIs('bar.index') || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        // Ak nie je vybraný bar, presmeruj na výber
        if (!$request->session()->has('bar')) {
            return redirect()->route('bar.index')->with('warning', 'Najprv si vyberte bar!');
        }

        return $next($request);
    }

    /**
     * Zisti, či je cesta v výnimkách
     */
    protected function shouldPassThrough($request): bool
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
