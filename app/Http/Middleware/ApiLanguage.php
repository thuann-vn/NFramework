<?php
// app/Http/Middleware/Language.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ApiLanguage
{
    public function handle($request, Closure $next)
    {
        //Get language param
        $lang = $request->route()->parameters['lang'];

        //Set language
        App::setLocale($lang);
        return $next($request);
    }
}