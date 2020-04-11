<?php
namespace Illuminate\Container;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Closure;
use ReflectionClass;

class Container implements ContainerContract
{
    protected static $instance;
    protected $instances = [];
    protected $bindings = [];


    public static function setInstance(ContainerContract $container = null)
    {
        return static::$instance = $container;
    }

    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    /****************
     * 1. bind
     *************/
    public function bind($abstract, $concrete = null, $shared = false)
    {

        if( is_null($concrete) )
        {
            $concrete = $abstract;
        }

        $this->bindings[$abstract]['concrete'] = $concrete;
        $this->bindings[$abstract]['shared'] = $shared;
    }
    /****************
     * 2. make
     *************/
    public function make($abstract, array $parameters = [])
    {
        return $this->resolve($abstract, $parameters);
    }
    /****************
     * 3. resolve
     *************/
    public function resolve($abstract, $parameters = [] )
    {
        // 객체가 배열에 저장되어 있는지 확인
        if( isset($this->instances[$abstract]) )
        {
            return $this->instances[$abstract];
        }

        $object = $this->returnNewConcrete_and_DI($abstract);

        if( $this->isShared($abstract) )
        {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }
    /****************
     * 4. build
     *************/
    public function returnNewConcrete_and_DI($abstract)
    {
        $concrete = $this->bindings[$abstract]['concrete'];

        $reflector = new ReflectionClass($concrete);


        if( is_null( $reflector->getConstructor() ) )
        {
            return new $concrete();
        }
        else
        {
            $construct = $reflector->getConstructor();

            $params = $construct->getParameters();

            $objs_for_args = [];

            foreach($params as $param)
            {
                $class_name = $param->getClass()->name;
                $objs_for_args[] = new $class_name();
            }

            return $object = $reflector->newInstanceArgs($objs_for_args);
        }
    }




    public function resolveClass($dependency)
    {
        $dependency_class = $dependency->getClass()->name;
        return new $dependency_class();
    }


    public function isShared($abstract)
    {
        return isset($this->instances[$abstract]) ||
            (isset($this->bindings[$abstract]['shared']) &&
                $this->bindings[$abstract]['shared'] === true);
    }



    public static function getInstance()
    {
        if (is_null(static::$instance))
        {
            static::$instance = new static;
        }
        return static::$instance;
    }


}