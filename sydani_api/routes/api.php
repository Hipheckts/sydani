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
// Route::group(['prefix' => 'v1'], function () {

//     Route::post('/login', 'UsersController@login')->name('login');
//     Route::post('/register', 'UsersController@register');
//     Route::post('/admin-login', 'UsersController@login')->name('admin-login');
//     Route::post('/reset-password', 'UsersController@resetPassword');
//     Route::post('/change-password/{id}', 'UsersController@changePassword');
//     Route::get('/logout', 'UsersController@logout')->middleware('auth:api');


//     Route::get('/search-users/{query}', 'UsersController@searchUsers')->name('search-users');
//     Route::get('/users/list', 'UsersController@listUsers')->middleware('auth:api');  //list with authentication
//     // Route::get('/users/list', 'UsersController@listUsers'); //list without authentication
// });

Route::group(['prefix' => ''], function () {

    Route::post('/login', 'UsersController@login')->name('login');
    Route::post('/register', 'UsersController@register');
    Route::post('/admin-login', 'UsersController@login')->name('admin-login');
    Route::post('/reset-password', 'UsersController@resetPassword');
    Route::post('/change-password/{id}', 'UsersController@changePassword');
    Route::get('/logout', 'UsersController@logout')->middleware('auth:api');


    Route::get('/search-users/{query}', 'UsersController@searchUsers')->name('search-users');
    Route::get('/users/list', 'UsersController@listUsers')->middleware('auth:api');  //list with authentication
    // Route::get('/users/list', 'UsersController@listUsers'); //list without authentication


    // Sydani Requests
    Route::get('/external-book/all-books', 'IceFireController@listAllBooks');

    Route::get('/external-book', 'IceFireController@reqOne');
});