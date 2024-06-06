<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\User\src\Http\Controllers'], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'UserControler@index')->name('admin.users.index');

            Route::get('/create', 'UserControler@create')->name('admin.users.create');
        });

    });

});




