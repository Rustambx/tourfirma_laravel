<?php
Route::group([
    'middleware' => 'web',
    'prefix' => 'hotels',
    'namespace' => 'App\Modules\Hotel\Controllers',

], function () {
    Route::get('/', 'HotelController@index')->name('hotels.index');
    Route::get('/{id}', 'HotelController@show')->name('hotels.show');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/hotels',
    'namespace' => 'App\Modules\Hotel\Controllers\Admin',

], function () {
    Route::get('/', 'HotelController@index')->name('admin.hotels.index');
    Route::get('/create', 'HotelController@create')->name('admin.hotels.create');
    Route::post('/store', 'HotelController@store')->name('admin.hotels.store');
    Route::get('/edit/{id}', 'HotelController@edit')->name('admin.hotels.edit');
    Route::put('/update/{id}', 'HotelController@update')->name('admin.hotels.update');
    Route::delete('/delete/{id}', 'HotelController@destroy')->name('admin.hotels.destroy');
});
