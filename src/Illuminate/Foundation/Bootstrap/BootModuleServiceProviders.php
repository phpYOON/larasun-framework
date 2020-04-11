<?php
namespace Illuminate\Foundation\Bootstrap;

use Illuminate\Foundation\Application;

class BootModuleServiceProviders
{

    public function booting(Application $app)
    {
        $arr = require __DIR__ . "/../../../../config/app.php";

        foreach($arr['providers'] as $provider)
        {
            $app->bind(\Illuminate\Support\ServiceProvider::class, $provider);

        }

        $provider = $app->make(\Illuminate\Support\ServiceProvider::class);

        $provider->boot();
    }
}

