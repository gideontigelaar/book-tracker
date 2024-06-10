<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/{pathMatch}', function () {
    return view('main');
})->where('pathmatch', '.*');