<?php
namespace Illuminate\Foundation\Middleware;

use Closure;

class RouteMiddlewareTest
{

    public function handle($request, Closure $next)
    {
        /*
        if(is_object($request))
        {
            echo "RouteMiddle_FAIL";
            return;
        }
        */

        return $next($request);
    }

}