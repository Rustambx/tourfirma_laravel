<?php
Route::group([
    'middleware' => 'web',
    'prefix' => 'tours',
    'namespace' => 'App\Modules\Tour\Controllers',

], function () {
    Route::get('/', 'TourController@index')->name('tours.index');
    Route::get('/{id}', 'TourController@show')->name('tours.show');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/tours',
    'namespace' => 'App\Modules\Tour\Controllers\Admin',

], function () {
    Route::get('/', 'TourController@index')->name('admin.tours.index');
    Route::get('/create', 'TourController@create')->name('admin.tours.create');
    Route::post('/store', 'TourController@store')->name('admin.tours.store');
    Route::get('/edit/{id}', 'TourController@edit')->name('admin.tours.edit');
    Route::put('/update/{id}', 'TourController@update')->name('admin.tours.update');
    Route::delete('/delete/{id}', 'TourController@destroy')->name('admin.tours.destroy');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/galleries',
    'namespace' => 'App\Modules\Tour\Controllers\Admin',

], function () {
    Route::get('/', 'GalleryController@index')->name('admin.galleries.index');
    Route::get('/create', 'GalleryController@create')->name('admin.galleries.create');
    Route::post('/store', 'GalleryController@store')->name('admin.galleries.store');
    Route::get('/edit/{id}', 'GalleryController@edit')->name('admin.galleries.edit');
    Route::put('/update/{id}', 'GalleryController@update')->name('admin.galleries.update');
    Route::delete('/delete/{id}', 'GalleryController@destroy')->name('admin.galleries.destroy');
});
