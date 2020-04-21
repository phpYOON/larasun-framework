<?php
namespace Illuminate\Container;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Closure;
use ReflectionClass;

class Container implements ContainerContract
{
    protected $bindings = [];
    protected $instances = [];
    
    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete, true);
    }

    /****************
     * 1. bind
     *************/
    public function bind($abstract, $concrete = null, $shared = false)
    {
        if( !isset($concrete) )
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
        //싱글톤이면
        if( $this->bindings[$abstract]['shared'] === true )
        {
            if( isset($this->instances[$abstract]) )
            {
                return $this->instances[$abstract];
            }
            $object = $this->instances[$abstract] = $this->build($abstract);

        }//팩토리패턴이면
        else if( $this->bindings[$abstract]['shared'] === false )
        {
            $object = $this->build($abstract);
        }

        return $object;
    }

    /****************
     * 4. build
     *************/
    public function build($abstract)
    {
        $concrete = $this->bindings[$abstract]['concrete'];

        if($abstract == $concrete)
        {
            return new $concrete();
        }

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






    public static function getInstance()
    {
        if (is_null(static::$instance))
        {
            static::$instance = new static;
        }
        return static::$instance;
    }


}