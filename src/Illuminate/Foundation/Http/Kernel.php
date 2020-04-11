<?php
namespace Illuminate\Foundation\Http;

use Illuminate\Contracts\Http\Kernel as KernelContract;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Middleware\MiddlewareTest;
/*====================================================
 *
 * 내부 Kernel
 *
 ====================================================*/
class Kernel implements KernelContract
{
    protected $app;
    protected $router;
    protected $middleware = [];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request)
    {
        $this->router = new Router($request);
        $this->sendRequestThroughRouter($request);
    }

    public function sendRequestThroughRouter($request)
    {
        $pipeline = new Pipeline($this->app);
        $pipeline->send($request)
                 ->through([new MiddlewareTest()])
                 ->then(function ($request){
                        $this->dispatchToRouter($request);
                 });
    }

    protected function dispatchToRouter(Request $request)
    {
        $this->router->dispatch($request, $this->app);
    }



    /*
    public function getRouter()
    {
        $this->router = new Router();

        return $this->router;
    }
    */



}



