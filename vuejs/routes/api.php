<?php

use Illuminate\Http\Request;

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
Route::prefix('category')->group( function () {
        Route::get('/', 'Api\CategoryController@index');
        Route::get('/find/{id}', 'Api\CategoryController@findID');
});
Route::prefix('products')->group( function () {
    Route::get('/', 'Api\ProductController@index');
    Route::get('/find/{id}', 'Api\ProductController@findID');
});
Route::get('products', 'Api\ProductController@index');
Route::get('manufacturers', 'Api\ManufacturerController@index');
Route::get('prices', 'Api\PriceController@index');
