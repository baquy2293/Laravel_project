<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\Courses\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', 'CoursesController@index')->name('index');
            Route::get('/create', 'CoursesController@create')->name('create');
            Route::post('/create', 'CoursesController@store')->name('store');
            Route::get('/data', 'CoursesController@data')->name('data');
            Route::get('edit/{course}', 'CoursesController@edit')->name('edit');
            Route::post('edit/{course}', 'CoursesController@update')->name('update');
            Route::post('delete/{course}', 'CoursesController@delete')->name('delete');
        });

    });

});
Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
