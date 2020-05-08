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

    // Password groups
    Route::post('/password-groups/store', 'PasswordGroupsController@store')->name('password_groups.store');

    //Projects
    Route::post('/projects/store', 'ProjectsController@store')->name('projects.store');

    //Passwords
    Route::post('/passwords/store', 'PasswordsController@store')->name('passwords.store');
    Route::post('/passwords/{password}/update', 'PasswordsController@update')->name('passwords.update');
    Route::get('/passwords/{password}', 'PasswordsController@show')->name('passwords.show');


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
