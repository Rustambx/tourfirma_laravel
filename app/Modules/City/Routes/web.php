<?php
Route::group([
    'middleware' => 'web',
    'prefix' => 'cities',
    'namespace' => 'App\Modules\City\Controllers',

], function () {
    Route::get('/{id}', 'CityController@show')->name('cities.show');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/cities',
    'namespace' => 'App\Modules\City\Controllers\Admin',

], function () {
    Route::get('/', 'CityController@index')->name('admin.cities.index');
    Route::get('/create', 'CityController@create')->name('admin.cities.create');
    Route::post('/store', 'CityController@store')->name('admin.cities.store');
    Route::get('/edit/{id}', 'CityController@edit')->name('admin.cities.edit');
    Route::put('/update/{id}', 'CityController@update')->name('admin.cities.update');
    Route::delete('/delete/{id}', 'CityController@destroy')->name('admin.cities.destroy');
});
