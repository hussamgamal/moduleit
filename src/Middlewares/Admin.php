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
        $role = $gaurds[0] ?? null;
        
        $user = auth('admin')->user();
        if (auth('admin')->check() && auth('admin')->user()->role) {
            $route_name = Route::currentRouteName();
            if (in_array($route_name, ['admin.home', 'admin.load'])) {
                return $next($request);
            }

            if ($user && $user->role_id && in_array($role, $user->role->roles)) {
                return $next($request);
            }
        }
        auth('admin')->logout();
        return redirect()->to('admin/login')->with('error', 'ليس لديك تصريح للدخول لهذة الصفحة');
    }
}
