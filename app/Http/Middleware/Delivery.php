<?php

namespace App\Http\Middleware;

use Closure;

class Delivery
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
        abort_unless(Auth::user()->isAdmin() || Auth::user()->isDelivery() , 403);

        return $next($request);
    }
}
