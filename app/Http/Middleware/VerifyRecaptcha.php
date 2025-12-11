<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyRecaptcha
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return $next($request);
        }

        if (!$request->isMethod('post')) {
            return $next($request);
        }


        $token = $request->input('g-recaptcha-response');
        if (!$token) {
            return back()->withErrors(['error' => 'reCAPTCHA token chýba. Obnovte stránku a skúste znova.']);
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $token,
            'remoteip' => $request->ip(),
        ]);

        $data = $response->json();

        if (!$response->successful() || !$data['success']) {
            $error = $data['error-codes'][0] ?? 'unknown-error';
            return back()->withErrors(['error' => "reCAPTCHA chyba: {$error}"]);
        }

        if (isset($data['score']) && $data['score'] < config('services.recaptcha.threshold', 0.5)) {
            return back()->withErrors(['error' => 'Podozrivá aktivita. Skúste to znova.']);
        }

        return $next($request);
    }
}
