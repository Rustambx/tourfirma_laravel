<?php
Route::group([
    'middleware' => ['web', 'auth'],
    'prefix' => 'admin/sliders',
    'namespace' => 'App\Modules\Slider\Controllers\Admin',

], function () {
    Route::get('/', 'SliderController@index')->name('admin.sliders.index');
    Route::get('/create', 'SliderController@create')->name('admin.sliders.create');
    Route::post('/store', 'SliderController@store')->name('admin.sliders.store');
    Route::get('/edit/{id}', 'SliderController@edit')->name('admin.sliders.edit');
    Route::put('/update/{id}', 'SliderController@update')->name('admin.sliders.update');
    Route::delete('/delete/{id}', 'SliderController@destroy')->name('admin.sliders.destroy');
});
