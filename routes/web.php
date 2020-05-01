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

Route::get('/', function(){
    return redirect('/login');
});

Route::get('/logout', function(){
    auth()->logout();

    return redirect('/login');
});

Route::post('/login', 'LoginController@login')->name('auth.login');

Auth::routes();

Route::middleware(['auth', 'permissions'])->group(function() {
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::get('/download/{id}', 'HomeController@download')->name('download');
    Route::get('/delete-file/{id}', 'HomeController@deleteFile')->name('delete_file');

    //Projects
    Route::get('/projects', 'ProjectsController@index')->name('projects_index');
    Route::get('/projects/new', 'ProjectsController@create')->name('projects_create');
    Route::post('/projects/new', 'ProjectsController@store')->name('projects_store');
    Route::get('/projects/{id}/edit', 'ProjectsController@edit')->name('projects_edit');
    Route::get('/projects/{id}/delete', 'ProjectsController@delete')->name('projects_delete');
    Route::post('/projects/{id}/update', 'ProjectsController@update')->name('projects_update');

    Route::get('/projects/{project}/passwords', 'PasswordsController@projectPasswordsList')->name('project_passwords_list');

    //Passwords
    Route::get('/passwords', 'PasswordsController@index')->name('passwords_index');

    Route::get('/passwords/new', 'PasswordsController@create')->name('passwords_create');
    Route::post('/passwords/new', 'PasswordsController@store')->name('passwords_store');
    Route::get('/passwords/{id}/edit', 'PasswordsController@edit')->name('passwords_edit');
    Route::get('/passwords/{id}/delete', 'PasswordsController@delete')->name('passwords_delete');
    Route::post('/passwords/{id}/update', 'PasswordsController@update')->name('passwords_update');

    //Settings
    Route::get('/settings/password-types', 'SettingsController@index')->name('settings_index');
    Route::get('/settings/password-types/new', 'SettingsController@create')->name('settings_create');
    Route::post('/settings/password-types/new', 'SettingsController@store')->name('settings_store');
    Route::get('/settings/password-types/{id}/edit', 'SettingsController@edit')->name('settings_edit');
    Route::post('/settings/password-types/{id}/update', 'SettingsController@update')->name('settings_update');
    Route::get('/settings/password-types/{id}/delete', 'SettingsController@delete')->name('settings_delete');
    Route::get('/settings/profile', 'SettingsController@profile')->name('settings_profile_edit');
    Route::post('/settings/profile', 'SettingsController@profile')->name('settings_profile_save');
    Route::get('/settings/permissions', 'SettingsController@permissions')->name('settings_permissions_edit');
    Route::post('/settings/permissions', 'SettingsController@permissions')->name('settings_permissions_save');
});
