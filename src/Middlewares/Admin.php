<?php

namespace MshMsh\Middlewares;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Admin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$gaurds)
    {
        if (auth('admin')->check()) {
            return $next($request);
        }
        return redirect()->to('admin/login')->with('error', 'ليس لديك تصريح للدخول لهذة الصفحة');
    }
}
