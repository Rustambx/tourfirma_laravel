<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index')->name('index');
Route::match(['get', 'post'], '/contacts', 'ContactsController@index')->name('contacts');
Route::match(['get', 'post'],'/ajax', 'AjaxCityController@getCities')->name('ajax');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],function() {
    Route::get('/', 'IndexController@index')->name('adminIndex');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
