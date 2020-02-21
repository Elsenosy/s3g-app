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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User routes

Route::get('user/all', 'UserController@index')->name('all-users')->middleware('auth');

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {
    Route::any('create', 'UserController@create')->name('create-user');       
    Route::get('edit/{id}', 'UserController@edit')->name('edit-user');
    Route::post('update/{id}', 'UserController@update')->name('update-user');
    Route::get('delete/{id}', 'UserController@destroy')->name('delete-user');
});

// Roles 
Route::get('/roles', 'RoleController@index')->name('get-roles');
Route::group(['prefix' => 'role', 'middleware' => ['auth']], function() {
    Route::get('create', 'RoleController@create')->name('create-role');
    Route::post('create', 'RoleController@store')->name('store-role');
    Route::get('del/{id}', 'RoleController@destroy')->name('del-role');
});


// Cats
Route::get('/cats', 'CategoryController@index')->name('get-cats');
Route::group(['prefix' => 'cats', 'middleware' => ['auth']], function() {
    Route::get('create', 'CategoryController@create')->name('cat-form');
    Route::post('create', 'CategoryController@store')->name('store-cat');
    Route::get('edit/{id}', 'CategoryController@edit')->name('edit-cat');
    Route::put('edit/{id}', 'CategoryController@update')->name('update-cat');
    Route::get('delete/{id}', 'CategoryController@destroy')->name('delete-cat');
});


// articles
Route::get('/articles', 'ArticleController@index')->name('get-articles');
Route::group(['prefix' => 'articles', 'middleware' => ['auth']], function() {
    Route::get('create', 'ArticleController@create')->name('article-form');
    Route::get('{id}', 'ArticleController@show')->name('show-article');
    Route::post('create', 'ArticleController@store')->name('store-article');
    Route::get('edit/{id}', 'ArticleController@edit')->name('edit-article');
    Route::put('edit/{id}', 'ArticleController@update')->name('update-article');
    Route::get('delete/{id}', 'ArticleController@destroy')->name('delete-article');
});



// Permissions 
Route::get('permission/create', 'PermissionController@create')->name('create-permission');