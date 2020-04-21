<?php
namespace Illuminate\Foundation\Http;

use Illuminate\Contracts\Http\Kernel as KernelContract;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Foundation\Middleware\MiddlewareTest;
use Illuminate\Support\Facades\RouteFacade;
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

    protected $bootstrappers = [
        \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
        \Illuminate\Foundation\Bootstrap\RegisterFacades::class
    ];


    public function handle($app, $request)
    {
        $this->app = $app;

        $app->singleton('router', \Illuminate\Routing\Router::class);

        RouteFacade::setFacadeApplication($app);
        RouteFacade::init($request);

        require $_ENV['APP_BASE_PATH'] . '/routes/web.php';

        RouteFacade::match()->call();


        //$this->router = new Router($app, $request);
        //$this->sendRequestThroughRouter($request);
    }



    /*
    public function sendRequestThroughRouter($request)
    {
        $this->bootstrap($this->app);

        $pipeline = new Pipeline($this->app);
        $pipeline->send($request)
                 ->through([new MiddlewareTest()])
                 ->then(function ($request){
                        $this->dispatchToRouter($request);
                 });
    }

    protected function dispatchToRouter(Request $request)
    {
        $this->router->dispatch($this->app, $request);
    }

    public function bootstrap($app)
    {
        $this->app->bootstrapWith($app, $this->bootstrappers);
    }
    */



    /*
    public function getRouter()
    {
        $this->router = new Router();

        return $this->router;
    }
    */



}



