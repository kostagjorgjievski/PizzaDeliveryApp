<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/users', 'UsersController');
    Route::resource('/addresses', 'AddressesController');
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('cart.addToCart');
    Route::get('/view-cart', 'CartController@viewCart')->name('cart.viewCart');
    Route::delete('/delete-item', 'CartController@remove')->name('cart.delete-item');
    Route::put('/update-cart', 'CartController@update')->name('cart.update-cart');
    Route::post('/orders.store', 'OrdersController@store')->name('orders.store');
    Route::get('/orders', 'OrdersController@index')->name('orders.index');
    
});

Route::middleware(['auth', 'verifyEmployee'])->group(function(){
    Route::get('/orders.employee', 'OrdersController@indexEmployee')->name('orders.employee');
    Route::put('/orders.update/{id}', 'OrdersController@updateProgress')->name('orders.updateOrder');
    
    
});

Route::middleware(['auth', 'verifyAdmin'])->group(function(){
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/items', 'ItemsController');
    Route::resource('employees', 'EmployeesController');
});


