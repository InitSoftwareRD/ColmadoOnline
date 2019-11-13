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
        if( Auth::user()->rol_id =! 4 )
        {
           Auth::logout();
           return redirect()->route('inicioAdmin');

        }

        return $next($request);
    }
}
