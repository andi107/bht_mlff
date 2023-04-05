<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RootAccess
{

    public function handle($request, Closure $next)
    {
        // dd($request);
        if (Auth::id() == '72252c8a-8947-4300-b933-90609c37a55d') {
            return $next($request);
        }
        return response()->json([
            'error' => 'Internal Server Error.',
        ], 500)
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-Frame-Options', 'DENY')
            ->header('X-XSS-Protection', '1; mode=block')
            ->header('Strict-Transport-Security', 'max-age=7776000; includeSubDomains');
    }
}
