<?php
namespace Illuminate\Foundation;

use Illuminate\Container\Container;
use Illuminate\Foundation\Bootstrap\RegisterProviders;

class Application extends Container
{
    protected $basePath;

    public function __construct($basePath = null)
    {
        $this->setBasePath($basePath);
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function basePath()
    {
        return $this->basePath;
    }

    public function configDiretoryPath($path = '')
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
    }

    /*===================================================================================*/
    /*
     * 서비스 프로바이더 구동
     */
    public function bootstrapWith($app, $bootstrappers)
    {
        foreach($bootstrappers as $bootstrapper)
        {
            parent::bind($bootstrapper);
            parent::make($bootstrapper)->bootstrap($this);
        }
    }


    /*===================================================================================*/

    /*===================================================================================*/



}