<?php
namespace Illuminate\Routing;

use Illuminate\Http\Request;

class Route
{
    public static $method;
    public static $uri;
    public static $action;

    public static $namespace = "\\App\\Http\\Controllers\\";
    public static $controller;


    protected static $arr = [ 'GET'=>[], 'POST'=>[] ];

    protected static $matched_route;

    public static function init(Request $r)
    {
        self::$method = $r->getMethod();
        self::$uri = $r->getUrl();
    }

    /*
     * HTTTP GET 메서드 임
     */
    public static function get($uri, $action)
    {
        // 클로저 함수면
        if( is_callable($action) )
        {
            $callback = $action;
            self::$arr['GET'][$uri] = $callback;
        }// 콘트롤러 액션 스트링 이면
        else
        {
            $array = explode('@', $action);
            self::$controller = $array[0];
            self::$action = $array[1];
            self::$arr['GET'][$uri] = "";
        }

    }

    public static function run()
    {
        self::match()->callAction();

    }


    public static function match()
    {
        //dd($this->uri);
        self::$matched_route = self::$arr[self::$method][self::$uri];

        return new static();
    }

    public static function callAction()
    {
        if( is_callable(self::$matched_route) )
        {
            $callable = self::$matched_route;
            return $callable();
        }
        else
        {
            $namespace_and_controller_name = self::$namespace . self::$controller;
            $action_name = self::$action;

            $newController = new $namespace_and_controller_name();
            $newController->$action_name();
        }
    }


    /*=============================================================================================*/
    public static function getMethod()
    {
        return self::$method;
    }

    public static function getUri()
    {
        return self::$uri;
    }
    /*=============================================================================================*/
    public static function getController()
    {
        return self::$controller;
    }

    public static function getControllerMethod()
    {
        return "";
    }

    public static function middleware($middleware = null)
    {
        self::$action['middleware'] = $middleware;

        //dd( $this->action['middleware'] );

        return self;
    }





}