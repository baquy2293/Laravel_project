<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\Categories\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'CategoriesControler@index')->name('index');
            Route::get('create', 'CategoriesControler@create')->name('create');
            Route::post('create', 'CategoriesControler@store');
            Route::get('data', 'CategoriesControler@data')->name('data');
            Route::get('edit/{id}', 'CategoriesControler@edit')->name('edit');
            Route::post('edit/{id}', 'CategoriesControler@update')->name('update');
            Route::post('delete/{id}', 'CategoriesControler@delete')->name('delete');
        });

    });

});
