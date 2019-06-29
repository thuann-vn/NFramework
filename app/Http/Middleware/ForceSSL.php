<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class ForceSSL
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        URL::forceScheme(env('APP_FORCE_SCHEME', 'https'));
        return $next($request);
    }
}
