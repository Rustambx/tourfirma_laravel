<?php
Route::group([
    'middleware' => 'web',
    'prefix' => 'countries',
    'namespace' => 'App\Modules\Country\Controllers',

], function () {
    Route::get('/', 'CountryController@index')->name('countries.index');
    Route::get('/{id}', 'CountryController@show')->name('countries.show');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/countries',
    'namespace' => 'App\Modules\Country\Controllers\Admin',

], function () {
    Route::get('/', 'CountryController@index')->name('admin.countries.index');
    Route::get('/create', 'CountryController@create')->name('admin.countries.create');
    Route::post('/store', 'CountryController@store')->name('admin.countries.store');
    Route::get('/edit/{id}', 'CountryController@edit')->name('admin.countries.edit');
    Route::put('/update/{id}', 'CountryController@update')->name('admin.countries.update');
    Route::delete('/delete/{id}', 'CountryController@destroy')->name('admin.countries.destroy');
});
