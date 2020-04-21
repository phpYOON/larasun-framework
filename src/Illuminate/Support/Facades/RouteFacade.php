<?php
namespace Illuminate\Support\Facades;

class RouteFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'router';
    }

}