<?php

use App\Http\Middleware\AppLogger;
use App\Http\Middleware\CheckBarSelected;
use App\Http\Middleware\UpdateLastActivity;
use App\Http\Middleware\VerifyRecaptcha;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // <-- import Auth
use App\Models\AppLog;                 // <-- uprav na správny namespace tvojho modelu
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        // Aliasuj len MIDDLEWARE triedy
        $middleware->alias([
            'recaptcha' => VerifyRecaptcha::class,
            // 'XmlParser' sem nepatrí – je to fasáda/služba, nie middleware
        ]);

        // Globálne middleware len ak musí ísť na všetky requesty (aj API)
        // $middleware->append(AppLogger::class);

        // Tieto potrebujú session/Auth => pridaj do 'web' skupiny
        $middleware->appendToGroup('web', [
            CheckBarSelected::class,
            UpdateLastActivity::class,
            AppLogger::class, // ak loguješ len web, je lepšie ho mať tiež vo 'web'
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if (class_exists(AppLog::class)) {
                $userId = Auth::id(); // bezpečné – vráti null ak nie je prihlásený
                AppLog::create([
                    'user_id' => $userId,
                    'method' => $request->method(),
                    'path' => $request->path(),
                    'request' => $request->except(['password', 'password_confirmation']), // vynechaj citlivé
                    'status' => 404,
                    'type' => 'web',
                    'success' => false,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'error' => $e->getMessage(),
                    'error_trace' => $e->getTraceAsString(),
                ]);
            }

            // Vyhni sa prípadnej slučke: ak už si na /login, neredirektuj
            if ($request->is('login')) {
                return null;
            }
            return redirect('/login');
        });

        $exceptions->renderable(function (HttpException $e, Request $request) {
            if (class_exists(AppLog::class)) {
                $userId = Auth::id();
                AppLog::create([
                    'user_id' => $userId,
                    'method' => $request->method(),
                    'path' => $request->path(),
                    'request' => $request->except(['password', 'password_confirmation']),
                    'status' => $e->getStatusCode(),
                    'type' => 'web',
                    'success' => false,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'error' => $e->getMessage(),
                    'error_trace' => $e->getTraceAsString(),
                ]);
            }

            if ($e->getStatusCode() === 403) {
                return redirect()->route('home');
            }

            return null; // nechaj Laravel použiť default render
        });
    })
    ->create();
