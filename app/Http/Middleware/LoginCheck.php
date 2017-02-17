<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheck
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
        if (auth()->guard('teacher')->check()) {
            return $next($request);
        } elseif (auth()->guard('student')->check()) {
            return $next($request);
        }
        return redirect('/');
    }
}
