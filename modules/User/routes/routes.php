<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\User\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'UserControler@index')->name('admin.users.index');
            Route::get('/create', 'UserControler@create')->name('admin.users.create');
            Route::post('/create', 'UserControler@store')->name('admin.users.store');
            Route::get('data', 'UserControler@data')->name('admin.users.data');
            Route::get('edit/{user}', 'UserControler@edit')->name('admin.users.edit');
            Route::post('edit/{user}', 'UserControler@update')->name('admin.users.update');
            Route::post('delete/{user}', 'UserControler@delete')->name('admin.users.delete');
        });

    });

});
