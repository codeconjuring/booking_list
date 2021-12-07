<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return "Cleared!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'HomeController@login')->name('login');
Route::post('/login', 'HomeController@attempt')->name('login');
Route::get('/logout', 'HomeController@logout')->name('logout');

// Reset Password
Route::get('reset/password/show', 'ForgotPassword@viewReset')->name('reset.password');
Route::post('reset/password/send', 'ForgotPassword@resetPassword')->name('send.reset.password');
Route::get('set/new/password/{uuid}', 'ForgotPassword@setNewPassword')->name('set.new.password');
Route::post('set/password/{uuid}', 'ForgotPassword@createNewPassword')->name('set.password');
