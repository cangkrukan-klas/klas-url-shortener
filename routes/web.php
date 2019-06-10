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
    return view('pages/home');
})->name('home');

Route::post('/', 'URLShortenerController@doShort');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/shorturl', 'AdminController@shorturl')->name('shorturl');
    Route::get('/shorturl/update', 'AdminController@update_shorturl')->name('shorturl.update');
    Route::get('/shorturl/get', 'AdminController@shorturl_get')->name('shorturl.get');
    Route::get('/shorturl/get/chart', 'AdminController@shorturl_get_chart')->name('shorturl.get.chart');
    Route::get('/customurl', 'AdminController@customurl')->name('customurl');
    Route::get('/customurl/update', 'AdminController@update_customurl')->name('customurl.get');
    Route::get('/customurl/get', 'AdminController@customurl_get')->name('customurl.get');

    Route::get('/shorturl/delete/{id}', 'AdminController@delete_shorturl')->name('shorturl.delete');
    Route::get('/customurl/delete/{id}', 'AdminController@delete_customurl')->name('customurl.delete');

    Route::post('/update-data-custom', 'AdminController@update_customurl')->name('customurl.update');
});

//Route::get('/en/{next}', 'LocalizationController@set_en');
Route::get('/en', 'LocalizationController@set_en');
//Route::get('/id/{next}', 'LocalizationController@set_id');
Route::get('/id', 'LocalizationController@set_id');

Route::get('/{shorturl}', 'URLShortenerController@go');