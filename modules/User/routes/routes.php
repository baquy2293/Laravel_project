<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'modules\User\src\Http\Controllers'], function () {
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserControler@index');
    });

});




