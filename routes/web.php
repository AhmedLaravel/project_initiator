<?php

use App\Controllers\HomeController;
use ProjectInitiator\Http\Route;

Route::get('/string', "App\Controllers\HomeController@index");
Route::get('/callable', function () {
    return strlen("hello php");
});

Route::get('/', [HomeController::class, "index"]);


