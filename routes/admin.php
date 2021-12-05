<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'LoginController@dashboard')->name('dashboard');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Add Another Book
    Route::get('form/add-more', 'Form\FormController@addMore')->name('form.add-more');
    Route::post('form/store-another/{book}', 'Form\FormController@storeAnother')->name('form.store-another');
    Route::get('form/add-another-title/{id}', 'Form\FormController@addAnotherTitle')->name('form.add-another-title');
    Route::post('form/add-another-book-list', 'Form\FormController@storeAnotherTitle')->name('add-another-book-list');
    // Download PDF
    Route::get('form/download', 'Form\FormController@downloadPdf')->name('form.download');
    // API Request
    Route::get('form/api-request', 'Form\FormController@selectLanguageSeries')->name('form.api_request');
    Route::resources([
        'setting'      => Setting\SettingController::class,
        'profile'      => Profile\ProfileController::class,
        'email'        => EmailConfig\EmailConfigSettingController::class,
        'series'       => Category\CategoryController::class,
        'form-builder' => FormBuilder\FormBuilderController::class,
        'form'         => Form\FormController::class,
        'role'         => Role\RoleController::class,
        'status'       => Status\StatusController::class,
    ]);
});
