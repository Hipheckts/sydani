<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => ''], function () {

    // Sydani IceFire Requests
    Route::get('/external-book/all-books', 'IceFireController@listAllBooks');

    Route::get('/external-book', 'IceFireController@reqOne');
});


Route::group(['prefix' => 'v1'], function () {

    // Sydani Local Books Design
    Route::post('/books', 'BookController@createBook')->name('create');

    Route::get('/books', 'BookController@listBooks')->name('books');

    Route::post('/books/{id}', 'BookController@updateBook')->name('update');
    
    Route::get('/books/{id}', 'BookController@deleteBook')->name('delete');

});