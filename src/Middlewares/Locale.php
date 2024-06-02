<?php

namespace MshMsh\Middlewares;

use Closure;

class Locale
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
        if ($request->wantsJson()) {
            $locale = request()->header('Accept-Language') ?? request()->header('Lang');
            if (in_array($locale, ['ar', 'en'])) {
                app()->setLocale($locale);
            } elseif (auth()->check()) {
                app()->setLocale(auth()->user()->lang);
            } else {
                app()->setLocale('ar');
            }
        } elseif ($lang = session('current_locale')) {
            app()->setLocale($lang);
        }
        return $next($request);
    }
}
