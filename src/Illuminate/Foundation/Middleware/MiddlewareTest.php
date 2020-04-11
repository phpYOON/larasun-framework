<?php
namespace Illuminate\Foundation\Middleware;

use Closure;

class MiddlewareTest
{

    public function handle($request, Closure $next)
    {
        /*
        if(is_object($request))
        {
            echo "FAIL";
            return;
        }
        */

        return $next($request);
    }

}