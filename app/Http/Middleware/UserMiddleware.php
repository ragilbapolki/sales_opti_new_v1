<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$levelRole)
    {
        if (auth()->check() && auth()->user()->level($levelRole)) {
            // return redirect ('/');
            return redirect()->route('home', 'cdi');
        }
        return $next($request);
    }
}
