<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace ('API')->middleware(['throttle'])->group(function () {
    Route::post('/login', 'LoginController@login');
});

Route::namespace ('API')->middleware(['throttle', 'auth:api'])->group(function () {
    Route::post('createproduct','ProductController@CreateProduct');
    Route::post('updateproduct','ProductController@UpdateProduct');
    Route::post('deleteproduct','ProductController@DeleteProduct');
    Route::post('productlist','ProductController@ProductList');
});
