<?php
namespace Illuminate\Foundation\Bootstrap;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\Finder\Finder;

class RegisterFacades
{

    public function bootstrap(Application $app)
    {
        Facade::setFacadeApplication($app);


        $arr = [];
        $providersDirectoryPath = $app->configDiretoryPath();
        foreach( Finder::create()->files()->name('*.php')->in($providersDirectoryPath) as $file )
        {
            $arr = require($file->getRealPath());

            foreach ( $arr['aliases'] as $key => $facade )
            {
                dump($facade);
                $app->bind($key, $facade);

            }
        }


    }

}