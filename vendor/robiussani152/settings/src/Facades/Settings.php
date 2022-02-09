<?php
namespace Robiussani152\Settings\Facades;
use \Illuminate\Support\Facades\Facade;
class Settings extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'settings';
    }
}
