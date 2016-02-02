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

Route::post('/', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('/', 'PageController@index');
Route::get('dashboard', 'UserController@home');
Route::get('home', 'UserController@home');
Route::get('create', 'UserController@create');
Route::post('create', 'UserController@createPost');
Route::get('record', 'UserController@record');
Route::get('export', 'UserController@export');
Route::get('search', 'UserController@search');
Route::post('search', 'UserController@searchPost');
Route::get('result-summary', 'UserController@resultSummary');
Route::post('result-summary', 'UserController@resultSummaryPost');
Route::get('result-full', 'UserController@resultFull');
Route::post('result-full', 'UserController@resultFullPost');
Route::get('result-mail-adress', 'UserController@resultMailAdress');
Route::post('result-mail-adress', 'UserController@resultMailAdressPost');