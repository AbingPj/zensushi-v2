<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

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



Auth::routes();

// WelcomPage
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcomepage', 'WelcomeController@welcome')->name('page.welcome');
Route::get('/', 'WelcomeController@welcome')->name('page.welcome');
Route::get('/registerpage', 'WelcomeController@register')->name('page.register');

// Page Controller
Route::get('/zensushi', 'PageController@home')->name('page.home');
Route::get('/zensushi-items', 'PageController@items')->name('page.items');
Route::get('/zensushi-records', 'PageController@records')->name('page.records');
Route::get('/zensushi-production', 'PageController@production')->name('page.production');;
Route::get('/zensushi-production/{item_id}', 'PageController@production2');
Route::get('/zensushi-production/{item_id}/{product_item_id}', 'PageController@production3');
Route::get('/zensushi-production/{item_id}/{product_item_id}/{item_raw_stock_out}', 'PageController@production4');



// Items Controller
Route::get('/items/item_types', 'ItemsController@item_types');
Route::get('/items/create/{id}', 'ItemsController@createItem');
Route::post('/items/create/item', 'ItemsController@createItemSave');
Route::get('/items/update/data/{id}', 'ItemsController@showUpdateItemModal');
Route::put('/items/update', 'ItemsController@updateItem');
Route::delete('/items/delete/{id}', 'ItemsController@deleteItem');
Route::post('/items/additional', 'ItemsController@AdditionalItem');
Route::get('/items', 'ItemsController@index');


// Route::post('/triggerPusher', 'ItemsController@triggerPusher');

// Records Controller
Route::get('/records', 'RecordsController@getRecords');

// Raw Controller
Route::get('/items/raw', 'ItemsRawController@getRawItems');
Route::post('/items/stockin', 'ItemsRawController@StockInRaw');
Route::post('/items/stockout', 'ItemsRawController@StockOutRaw');
Route::get('/item/balance/{item_id}', 'ItemsRawController@getItemBalance');

// Products Controller
Route::get('/items/products', 'ItemsProductController@getProductItems');
Route::get('/items/products/{item_id}', 'ItemsProductController@getProductItemsByRaw');
Route::get('/items/stockin/rawproduct/{item_id}', 'ItemsProductController@StockInRawProduct');
Route::get('/items/stockin/rawproduct/{item_id}/{raw_product_id}', 'ItemsProductController@StockInRawProduct2');
// Route::get('/items/stockin/rawproduct/{item_id}/{raw_product_id}/{item_raw_stock_out}', 'ItemsProductController@production4');
Route::post('/items/products/stockin', 'ItemsProductController@saveProductsIn');




Route::get('/in_raw_products', function () {
    return view('app.pages.items.items-raw-product-in');
});

///Loading Sample page
Route::get('loading', function () {
    return view('loading');
});


Route::get('/test', 'TestController@test');
Route::get('/test2', 'TestController@test2');


