<?php
namespace Illuminate\Foundation\Bootstrap;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class BootKernelServiceProviders
{


    public function booting(Application $app)
    {
        $request = new Request();
        Route::dispatch($request);

        Route::load(__DIR__ . '/../../../../routes/web.php');

        Route::match()->call();


    }

}

