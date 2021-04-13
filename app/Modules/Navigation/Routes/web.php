<?php
Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/navigations',
    'namespace' => 'App\Modules\Navigation\Controllers\Admin',

], function () {
    Route::get('/', 'NavigationController@index')->name('admin.navigations.index');
    Route::get('/create', 'NavigationController@create')->name('admin.navigations.create');
    Route::post('/store', 'NavigationController@store')->name('admin.navigations.store');
    Route::get('/edit/{id}', 'NavigationController@edit')->name('admin.navigations.edit');
    Route::put('/update/{id}', 'NavigationController@update')->name('admin.navigations.update');
    Route::delete('/delete/{id}', 'NavigationController@destroy')->name('admin.navigations.destroy');
});
