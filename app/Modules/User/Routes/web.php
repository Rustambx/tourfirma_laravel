<?php
Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/users',
    'namespace' => 'App\Modules\User\Controllers',

], function () {
    Route::get('/', 'UserController@index')->name('admin.users.index');
    Route::get('/create', 'UserController@create')->name('admin.users.create');
    Route::post('/store', 'UserController@store')->name('admin.users.store');
    Route::get('/edit/{id}', 'UserController@edit')->name('admin.users.edit');
    Route::put('/update/{id}', 'UserController@update')->name('admin.users.update');
    Route::delete('/delete/{id}', 'UserController@destroy')->name('admin.users.destroy');
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/permissions',
    'namespace' => 'App\Modules\User\Controllers',

], function () {
    Route::get('/', 'PermissionController@index')->name('admin.permissions.index');
    Route::post('/store', 'PermissionController@store')->name('admin.permissions.store');
});
