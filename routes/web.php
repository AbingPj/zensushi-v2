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

// Items Controller
Route::get('/items', 'ItemsController@index');
Route::get('/items/item_types', 'ItemsController@item_types');
Route::get('/items/create/{id}', 'ItemsController@createItem');
Route::post('/items/create/item', 'ItemsController@createItemSave');
Route::post('/items/remove/{id}', 'ItemsController@removeItem');



///Loading Sample page
Route::get('loading', function () {
    return view('loading');
});
