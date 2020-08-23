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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'AddUserId']], function() {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/get-user-links', 'LinkController@getUserLinks')->name('user.links');
	Route::post('/shorten', ['as' => 'pshorten', 'uses' => 'LinkController@performShorten']);

});

Route::get('/{short_url}', 'LinkController@performRedirect');