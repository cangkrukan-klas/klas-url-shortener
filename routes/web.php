<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/home/admin', 'UserController');

Route::resource('/home/shorturl', 'ShortUrlController');

Route::resource('/home/customurl', 'CustomUrlController');

Route::resource('/home/akses', 'AksesController');

Route::post('/', 'URLShortenerController@doShort');

Route::get('/{shorturl}', 'URLShortenerController@go');