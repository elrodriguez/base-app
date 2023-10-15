<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->prefix('onlineshop')->group(function () {
    Route::get('dashboard', 'OnlineshopController@index')->name('onlineshop_dashboard');
    Route::get('items', 'OnliItemController@index')->name('onlineshop_items');
    Route::get('items/create', 'OnliItemController@create')->name('onlineshop_items_create');
    Route::get('sales', 'OnliSaleController@index')->name('onlineshop_sales');
});
