<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->has('lang') && in_array($request->input('lang'), ['en', 'EN', 'ar'])) {
            app()->setLocale($request->input('lang'));
        }
        return $next($request);
    }
}
