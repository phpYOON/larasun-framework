<?php
namespace Illuminate\Foundation\Bootstrap;

use Illuminate\Foundation\Application;
use Symfony\Component\Finder\Finder;

class RegisterProviders
{


    public function bootstrap(Application $app)
    {
        $arr = [];

        $providersDirectoryPath = $app->configDiretoryPath();

        foreach( Finder::create()->files()->name('*.php')->in($providersDirectoryPath) as $file )
        {
            $arr = require($file->getRealPath());

            foreach ($arr['providers'] as $provider)
            {
                $app->bind($provider, $provider);
                $object = $app->make($provider);

                $object->boot();
                $object->register();
            }
        }
    }


}