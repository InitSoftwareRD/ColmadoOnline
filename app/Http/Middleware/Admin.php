<?php

namespace App\Http\Middleware;


use Closure;
use Auth;

class Admin
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
        
        abort_unless( auth()->check() && Auth::user()->isAdmin(), 403);

        return $next($request);
    }
}
