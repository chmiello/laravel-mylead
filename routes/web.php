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

Route::group(['middleware' => 'auth', 'namespace' => 'Manager', 'as' => 'products.', 'prefix' => 'products'], function() {
    Route::get('/', 'ProductsController@index')->name('list');
    Route::get('/create', 'ProductsController@create')->name('create');
    Route::post('/store', 'ProductsController@store')->name('store');
});