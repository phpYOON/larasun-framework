<?php
namespace Illuminate\Foundation;

use Illuminate\Container\Container;

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


    public function boot_Kernel_ServiceProviders()
    {
        //$bootKernel = new BootKernelServiceProviders();
        //$bootKernel->booting($this);
    }

    public function boot_Module_ServiceProviders()
    {
        //$bootModule =new BootModuleServiceProviders();
        //$bootModule->booting($this);
    }


}