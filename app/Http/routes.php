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

ROute::resource('admin/questions', 'QuestionController');
