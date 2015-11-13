<?php

/**
 * Home route
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Authentication routes
 */
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

/**
 * Admin routes
 */
Route::get('admin', 'AdminController@index');
Route::get('admin/questions', 'QuestionController@view');

/**
 * API routes
 */

Route::group(['prefix' => 'api/v1'], function() {
	Route::get('questions/page/{pagination}', 'QuestionController@index');
	Route::post('questions', 'QuestionController@create');
	Route::put('questions/{questions}', 'QuestionController@edit');
});