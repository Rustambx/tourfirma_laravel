<?php
Route::group([
    'middleware' => 'web',
    'prefix' => 'news',
    'namespace' => 'App\Modules\News\Controllers',
], function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/{id}', 'NewsController@show')->name('news.show');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/news',
    'namespace' => 'App\Modules\News\Controllers\Admin',

], function () {
    Route::get('/', 'NewsController@index')->name('admin.news.index');
    Route::get('/create', 'NewsController@create')->name('admin.news.create');
    Route::post('/store', 'NewsController@store')->name('admin.news.store');
    Route::get('/edit/{id}', 'NewsController@edit')->name('admin.news.edit');
    Route::put('/update/{id}', 'NewsController@update')->name('admin.news.update');
    Route::delete('/delete/{id}', 'NewsController@destroy')->name('admin.news.destroy');
});
