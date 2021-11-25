<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

// Route::post('login', 'LoginController@submitLogin')->name('login');
Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
Route::middleware([])->group(function () {
    // Route::post('logout', 'LoginController@logout')->name('logout');

    // Route::resources([
    // ]);
});
