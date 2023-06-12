<?php
namespace Pranthokumar\ProtectDb\App\Facades;

use Illuminate\Support\Facades\Facade;

class ProtectDb extends Facade
{
    


    protected static function getFacadeAccessor()
    {
        return 'protectdb';
    }
}