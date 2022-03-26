<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'LoginController@dashboard')->name('dashboard');
    Route::get('production/production-dashboard', 'Production\ProductionDashboardController@index')->name('production.production-dashboard');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Add Another Book
    Route::get('form/add-another-title/{id}', 'Form\FormController@addAnotherTitle')->name('form.add-another-title');
    Route::post('form/add-another-book-list', 'Form\FormController@storeAnotherTitle')->name('add-another-book-list');
    // Download PDF
    Route::get('form/download', 'Form\FormController@downloadPdf')->name('form.download');
    // API Request
    Route::get('form/api-request', 'Form\FormController@selectLanguageSeries')->name('form.api_request');
    Route::post('form-builder/table-sort', 'FormBuilder\FormBuilderController@tableSort')->name('table.sort');
    Route::get('form/get-another-lanugage', 'Form\FormController@getAnotherLanguage')->name('form.get-another-lanugage');
// Show more book title


//show book details
    Route::get('form/get-book-details/{id}', 'Form\FormController@getBookDetails')->name('form.get-book-details');
    // Search Text
    // Route::get('form/search-text', 'Form\FormController@searchText')->name('form.search-text');

    // get serieswise language/titles
    Route::get('production/get-serieswise-lanstitles', 'Production\ProductionDepartmentController@getSeriesWiseLanTitle')->name('production.get-serieswise-lanstitles');
    // get data on a year
    Route::get('production/get-data-on-a-year', 'Production\ProductionDashboardController@getDataOnAYear')->name('production.get-data-on-a-year');
    // get production house data
    Route::get('production/get-production-house-data', 'Production\ProductionDashboardController@productionByProductionHouse')->name('production.get-production-house-data');

    Route::resources([
        'setting'               => Setting\SettingController::class,
        'profile'               => Profile\ProfileController::class,
        'email'                 => EmailConfig\EmailConfigSettingController::class,
        'series'                => Series\CategoryController::class,
        'form-builder'          => FormBuilder\FormBuilderController::class,
        'form'                  => Form\FormController::class,
        'role'                  => Role\RoleController::class,
        'status'                => Status\StatusController::class,
        'user'                  => User\UserController::class,
        'category'              => Category\CategoryController::class,
        'author'                => Author\AuthorController::class,
        'proof-reader'          => ProofReader\ProofReaderController::class,
        'narrator'              => Narrator\NarratorController::class,
        'production-house'      => Production\ProductionHouseController::class,
        'production-department' => Production\ProductionDepartmentController::class,
    ]);
});
