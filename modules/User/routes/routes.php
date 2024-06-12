<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\User\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UserControler@index')->name('index');
            Route::get('/create', 'UserControler@create')->name('create');
            Route::post('/create', 'UserControler@store')->name('store');
            Route::get('data', 'UserControler@data')->name('data');
            Route::get('edit/{user}', 'UserControler@edit')->name('edit');
            Route::post('edit/{user}', 'UserControler@update')->name('update');
            Route::post('delete/{user}', 'UserControler@delete')->name('delete');
        });

    });

});
