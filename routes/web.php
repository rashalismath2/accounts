<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/items', 'ItemController@index')->name('items');

Route::get('/items/create', 'ItemController@ShowCreate')->name('create_item');
Route::post('/items/create', 'ItemController@CreateNew')->name('save_item');

Route::post('/items/edit', 'ItemController@edit')->name('edit_item');
Route::put('/items/edit', 'ItemController@SaveEdit')->name('save_edit_item');

Route::delete('/items/delete', 'ItemController@delete')->name('delete_item');
