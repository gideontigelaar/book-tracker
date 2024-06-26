<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/books', 'App\Http\Controllers\BookController@index');
Route::post('/books', 'App\Http\Controllers\BookController@store');
Route::get('/books/{book}', 'App\Http\Controllers\BookController@show');
Route::put('/books/{book}', 'App\Http\Controllers\BookController@update');
Route::delete('/books/{book}', 'App\Http\Controllers\BookController@destroy');
Route::post('/books/check-isbn', [BookController::class, 'checkISBN']);