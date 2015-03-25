<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('recomendation', 'HomeController@recomendation');
Route::get('lastfm', 'HomeController@lastfm');

Route::get('lastfm/update', 'LastfmController@updateDbWithPopular');
Route::get('lastfm/updateFans', 'LastfmController@updateDbWithFans');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
