<?php
namespace Illuminate\Support\Facades;

abstract class Facade
{
    protected static $app;

    public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }

    public static function __callStatic($method, $arguments)
    {
        return static::$app->make(static::getFacadeAccessor())->$method(...$arguments);
    }
}


