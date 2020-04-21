<?php
namespace Illuminate\Database;

class Database
{
    protected $connection;

    public function connect()
    {
        echo "_connect_";
    }
}

