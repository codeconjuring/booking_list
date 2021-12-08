<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class EmailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $email_setting = widgets('email_setting');
        // dd($email_setting);
        if ($email_setting) {

            $config = array(
                'driver'     => 'smtp',
                'host'       => $email_setting->contents['host'],
                'port'       => $email_setting->contents['port'],
                'from'       => array('address' => $email_setting->contents['from_address'], 'name' => $email_setting->contents['from_name']),
                'encryption' => $email_setting->contents['encryption'],
                'username'   => $email_setting->contents['username'],
                'password'   => $email_setting->contents['password'],
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
            );
            Config::set('mail', $config);
            // Log::debug(config('mail'));
        }

    }
}
