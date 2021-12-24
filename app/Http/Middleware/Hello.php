<?php

namespace App\Http\Middleware;

use Closure;

class Hello
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
        //cac code xu ly se dat o day
        echo "<h1>Middleware Hello duoc goi</h1>";
        return $next($request);
    }
}
