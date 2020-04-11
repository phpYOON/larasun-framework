<?php
namespace Illuminate\Database;

use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        echo "_database_";
    }


}

