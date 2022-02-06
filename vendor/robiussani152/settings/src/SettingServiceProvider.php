<?php
namespace Robiussani152\Settings;
use \Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        $this->app->bind('settings', function (){
            return new SettingsFacade();
        });
    }
}
