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

Route::get('/home', 'HomeController@index')->name('home');

// User routes

Route::get('user/all', 'UserController@index')->name('all-users')->middleware('auth');

Route::group(['prefix' => 'user', 'middleware' => ['auth','role:owner']], function() {
    Route::any('create', 'UserController@create')->name('create-user');       
    Route::get('edit/{id}', 'UserController@edit')->name('edit-user');
    Route::post('update/{id}', 'UserController@update')->name('update-user');
    Route::get('delete/{id}', 'UserController@destroy')->name('delete-user');
});

// Roles 
Route::get('role/create', 'RoleController@create')->name('create-role');

// Permissions 
Route::get('permission/create', 'PermissionController@create')->name('create-permission');