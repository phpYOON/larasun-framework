<?php
namespace Illuminate\Routing;

use Illuminate\Foundation\Middleware\RouteMiddleware_test;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Foundation\Middleware\RouteMiddlewareTest;

class Router
{
    protected $container;

    protected $route;
    protected $routeMiddleware = [];

    public function __construct(Request $request)
    {
        Route::init($request);
    }
    /*
     * Kernel 에서 호출하는 진입 지점임
     */
    public function dispatch(Request $request, $app)
    {
        // GET 명령어가 여기에
        require $_ENV['APP_BASE_PATH'] . '/routes/web.php';

        $this->runRouteWithinStack($request, $app);
    }

    public function runRouteWithinStack($request, $app)
    {
        $pipeline = new Pipeline($app);
        $pipeline->send($request)
                 ->through([new RouteMiddlewareTest()])
                 ->then(function (){
                     Route::run();
                 });

    }


}