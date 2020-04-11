<?php
use Illuminate\Container\Container;
use Illuminate\Support\Env;

function app($abstract = null, array $parameters=[])
{
    if (is_null($abstract))
    {
        return Container::getInstance();
    }

    return Container::getInstance()->make($abstract, $parameters);
}

function env($key, $default = null)
{
    return Env::get($key, $default);
}

