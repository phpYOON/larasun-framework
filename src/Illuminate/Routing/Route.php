<?php
namespace Illuminate\Routing;

use Illuminate\Http\Request;

class Route
{
    protected $request;
    protected $path;
    protected $action;

    protected $arr = [ 'GET'=>[], 'POST'=>[] ];
    protected $url;
    protected $method;
    protected $matched_route;

    public function __construct($path, $action, Request $request)
    {
        $this->request = $request;
        $this->path = $path;
        $this->action = $action;
        $this->url = $request->getUrl();
        $this->method = $request->getMethod();
    }

    public function execute()
    {
        if( $this->request->getMethod() == 'GET' )
        {
            $this->get($this->path, $this->action);
        }

        else if ( $this->request->getMethod() == 'POST' )
        {

        }
    }

    public function get($path, $action)
    {

    }

    public function post()
    {

    }


}