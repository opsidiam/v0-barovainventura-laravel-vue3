<?php

namespace App\Http\Middleware;

use App\Models\AppLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

class AppLogger
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);

            $ignoredPaths = [
                'session-check',
                'admin/data-table',
                'app/stocktake/live/check-data',
                '_debugbar',
            ];

            // Univerzálne získanie status kódu
            $status = $this->getResponseStatusCode($response);

            if ($status >= 400 && $status < 600) {
                $this->logError($request, new \Exception("HTTP Error $status"));
            }

            if ($this->shouldLogRequest($request)) {
                $this->logRequest($request, $response, $status);
            }

            return $response;

        } catch (Throwable $e) {
            $this->logError($request, $e);
            throw $e;
        }
    }

    protected function shouldLogRequest(Request $request): bool
    {
        $ignoredPaths = [
            'session-check',
            'admin/data-table',
            'app/stocktake/live/check-data',
            '_debugbar',
        ];

        return !in_array($request->path(), $ignoredPaths) &&
            !str_contains($request->path(), 'admin/data-table') &&
            !str_contains($request->path(), 'sms/temperature') &&
            !str_contains($request->path(), '_debugbar') &&
            $request->all() != [];
    }

    protected function getResponseStatusCode($response): int
    {
        if (method_exists($response, 'status')) {
            return $response->status();
        }

        if (method_exists($response, 'getStatusCode')) {
            return $response->getStatusCode();
        }

        return 200; // Default status ak sa nedá zistiť
    }

    protected function logRequest(Request $request, $response, int $status): void
    {
        $user = Auth::user();
        $isSuccessful = ($status >= 200 && $status < 300) || $status === 302;

        AppLog::create([
            'user_id' => $user?->id,
            'method' => $request->method(),
            'path' => $request->path(),
            'request' => $request->all(),
            'status' => $status,
            'type' => 'web',
            'success' => $isSuccessful,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'error' => null,
        ]);
    }

    protected function logError(Request $request, Throwable $e): void
    {
        $user = Auth::user();
        AppLog::create([
            'user_id' => $user?->id,
            'method' => $request->method(),
            'path' => $request->path(),
            'request' => $request->all(),
            'status' => 500,
            'type' => 'web',
            'success' => false,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'error' => $e->getMessage(),
            'error_trace' => $e->getTraceAsString(),
        ]);
    }
}
