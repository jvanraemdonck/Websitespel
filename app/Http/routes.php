<?php

/**
 * Home route
 */
Route::get('/', 'GameController@index');
Route::post('/', 'GameController@answer');
Route::post('/tip', 'GameController@tip');
Route::get('/reglement', 'GameController@reglement');
Route::get('/stand', 'GameController@stand');

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
Route::post('admin/teams/{team}/reset', 'TeamController@resetPassword');
Route::post('admin/teams/resetPasswords', 'TeamController@resetPasswords');

Route::resource('admin/questions', 'QuestionController');
Route::resource('admin/questions/{question}/answers', 'AnswerController');
Route::resource('admin/teams', 'TeamController');
Route::resource('admin/admins', 'AdminAccountController');
Route::resource('admin/extra', 'ExtraQuestionController');

/**
 * API routes
 */

Route::group(['prefix' => 'api/v1'], function() {
	Route::get('questions/', 'QuestionController@all');
	Route::get('answers/{question}', 'AnswerController@all');
	Route::get('teams/', 'TeamController@all');
	Route::post('questions/sequence/{question}', 'QuestionController@changeSequence');
});