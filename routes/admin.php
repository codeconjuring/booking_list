<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'LoginController@dashboard')->name('dashboard');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::resources([
        'setting' => Setting\SettingController::class,
        'profile' => Profile\ProfileController::class,
        'email'   => EmailConfig\EmailConfigSettingController::class,
    ]);
});
