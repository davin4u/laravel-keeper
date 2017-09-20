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


Route::group(['before' => 'auth'], function() {
    Route::get('/home', 'HomeController@index');

    //Projects
    Route::get('/projects', 'ProjectsController@index');
    Route::get('/projects/new', 'ProjectsController@create');
    Route::post('/projects/new', 'ProjectsController@store');
    Route::get('/projects/{id}/edit', 'ProjectsController@edit');
    Route::get('/projects/{id}/delete', 'ProjectsController@delete');
    Route::post('/projects/{id}/update', 'ProjectsController@update');

    Route::get('/projects/{project}/passwords', 'PasswordsController@projectPasswordsList');

    //Passwords
    Route::get('/passwords', 'PasswordsController@index');

    Route::get('/passwords/new', 'PasswordsController@create');
    Route::post('/passwords/new', 'PasswordsController@store');
    Route::get('/passwords/{id}/edit', 'PasswordsController@edit');
    Route::get('/passwords/{id}/delete', 'PasswordsController@delete');
    Route::post('/passwords/{id}/update', 'PasswordsController@update');
});
