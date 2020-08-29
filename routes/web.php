<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/items', 'ItemController@index')->name('items');
Route::get('/items/create', 'ItemController@ShowCreate')->name('create_item');
Route::post('/items/create', 'ItemController@CreateNew')->name('save_item');
