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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/merchant/status/{id}','AdminController@ChangeStatus')->name('merchant.status');
    Route::get('/merchant','AdminController@index')->name('merchant.index');
    Route::get('/merchant-edit/{id}','AdminController@edit')->name('merchant.edit');
    Route::put('/merchant-update/{id}','AdminController@update')->name('merchant.update');
    Route::delete('/merchant-/{id}','AdminController@destroy')->name('merchant.destroy');
    Route::get('/merchant/status/{id}','AdminController@ChangeStatus')->name('merchant.status');
    Route::get('/merchant/products','AdminController@MerChantProducts')->name('merchant.products');

});

Route::group(['middleware' => ['auth'], 'prefix' => 'merchant', 'namespace' => 'Merchant'], function () {
    Route::get('/products/status/{id}','ProductController@ChangeStatus')->name('products.status');
    Route::resource('/products', 'ProductController');
});
