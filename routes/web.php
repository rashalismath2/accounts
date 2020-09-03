<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


// Items
Route::get('/items', 'ItemController@index')->name('items');
Route::get('/items/create', 'ItemController@ShowCreate')->name('create_item');
Route::post('/items/create', 'ItemController@CreateNew')->name('save_item');
Route::post('/items/edit', 'ItemController@edit')->name('edit_item');
Route::put('/items/edit', 'ItemController@SaveEdit')->name('save_edit_item');
Route::delete('/items/delete', 'ItemController@delete')->name('delete_item');

// Sales- Invoices
Route::get('/invoices',"InvoiceController@index")->name("invoices");
Route::get('/invoices/create',"InvoiceController@ShowCreate")->name("create_invoice");
Route::post('/invoices/create',"InvoiceController@CreateNew")->name("save_invoice_item");

//Sales- Revenues
Route::get('/revenues',"RevenueController@index")->name("revenues");
Route::get('/revenues/create',"RevenueController@ShowCreate")->name("create_revenue");
Route::post('/revenues/create',"RevenueController@CreateNew")->name("save_revenue");

//Sales- Customers
Route::get('/customers',"CustomerController@index")->name("customers");
Route::get('/customers/create',"CustomerController@ShowCreate")->name("create_customer");
Route::post('/customers/create',"CustomerController@CreateNew")->name("save_customer");
