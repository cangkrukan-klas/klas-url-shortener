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
});

Route::post('/', 'URLShortenerController@doShort');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/shorturl', 'AdminController@shorturl')->name('shorturl');
    Route::get('/customurl', 'AdminController@customurl')->name('customurl');

    Route::get('/shorturl/delete/{id}', 'AdminController@delete_shorturl')->name('shorturl.delete');
    Route::get('/customurl/delete/{id}', 'AdminController@delete_customurl')->name('customurl.delete');
});

Route::get('/{shorturl}', 'URLShortenerController@go');