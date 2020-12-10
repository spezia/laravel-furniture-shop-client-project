<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
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
        $locale = $request->segment(1, config('app.locale'));  // for example: en, fr, de..

        // not allowed locale in url?
        if (!in_array($locale, config('app.locales'))) {
            abort(Response::HTTP_NOT_FOUND);
        }

        app()->setLocale($locale);

        // remove lang param in controller
        $request->route()->forgetParameter('locale');
        // add route def value for locale to avoid defining locale in blade route param
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
