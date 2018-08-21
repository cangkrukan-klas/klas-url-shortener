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

Route::get('/home/admin', 'UserController@index');

Route::get('/home/shorturl', 'ShortUrlController@index');

Route::get('/home/customurl', 'CustomUrlController@index');

Route::get('/home/about', 'AboutController@index');

Route::post('/', 'URLShortenerController@doShort');

Route::get('/{shorturl}', 'URLShortenerController@go');