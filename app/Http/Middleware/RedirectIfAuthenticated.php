<?php

namespace App\Http\Middleware;

use App\Providers\AdminRouteServiceProvider;
use App\Providers\StudentRouteServiceProvider;
use App\Providers\TeacherRouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == "admin") {
                    return redirect(AdminRouteServiceProvider::HOME);
                }
                if ($guard == "teacher") {
                    return redirect(TeacherRouteServiceProvider::HOME);
                }
                if ($guard == "student") {
                    return redirect(StudentRouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
