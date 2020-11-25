<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localeFromUrl = $request->segment(1);  // for example: en, fr, de..

        // no locales in url than use default
        if (!$localeFromUrl) {
            $localeFromUrl = config('app.locale');
        }

        // not allowed locale in url?
        if (!in_array($localeFromUrl, config('app.locales'))) {
            abort(Response::HTTP_NOT_FOUND);
        }

        app()->setLocale($localeFromUrl);

        $request->route()->forgetParameter('locale'); // remove lang param in controller

        return $next($request);
    }
}
