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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('studies/create', 'Admin\StudiesController@add');
     Route::post('studies/create', 'Admin\StudiesController@create');
     Route::get('studies', 'Admin\StudiesController@index'); // 追記
     Route::get('studies/edit', 'Admin\StudiesController@edit'); // 追記
     Route::post('studies/edit', 'Admin\StudiesController@update'); // 追記
     Route::get('studies/delete', 'Admin\StudiesController@delete');# 追記
});
Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin'], function() {
Route::get('studies/create', 'Admin\StudiesController@add')->middleware('auth');
});
Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::get('profile', 'Admin\ProfileController@index')->middleware('auth');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('profile/create', 'Admin\ProfileController@add');
     Route::post('profile/create', 'Admin\ProfileController@create'); 
     Route::post('profile/edit', 'Admin\ProfileController@update');
     Route::get('profile/delete', 'Admin\ProfileController@delete');# 追記# 追記
});
Route::get('/', 'StudiesController@index');
Route::get('/profile', 'ProfileController@index');