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
    Route::get('/projects/edit/{id}', 'ProjectsController@edit');
    Route::get('/projects/delete/{id}', 'ProjectsController@delete');
});
