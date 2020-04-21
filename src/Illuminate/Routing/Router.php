<?php
namespace Illuminate\Routing;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Middleware\RouteMiddleware_test;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Foundation\Middleware\RouteMiddlewareTest;

class Router
{
    protected $routes = [ 'GET'=>[], 'POST'=>[] ];
    protected $req_url;
    protected $req_method;
    protected $matched_by_Request;

    public function init(Request $req)
    {
        $this->req_url = $req->getUrl();
        $this->req_method = $req->getMethod();
    }

    public function get($path, $action)
    {
        $this->routes['GET'][$path] = $action;
    }

    public function match()
    {
        $this->matched_by_Request = $this->routes[$this->req_method][$this->req_url];

        return $this;
    }

    public function call()
    {
        if( is_callable($this->matched_by_Request) )
        {
            $action = $this->matched_by_Request;
            return $action();
        }
    }










    /*
     * Kernel 에서 호출하는 진입 지점임
     */
    /*
    public function dispatch($app, Request $request)
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
     */

}