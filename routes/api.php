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

// Get all suppliers
Route::get('/apiGetAllSuppliers','Api\ApiDataAndroidController@apiGetAllSuppliers')->name('api.apiGetAllSuppliers');
// Get all customer
Route::get('/apiGetAllCustomer','Api\ApiDataAndroidController@apiGetAllCustomer')->name('api.apiGetAllCustomer');
// Store product-in
Route::post('/apiStoreProductIn','Api\ApiDataAndroidController@apiStoreProductIn')->name('api.apiStoreProductIn');
// Store product-out
Route::post('/apiStoreProductOut','Api\ApiDataAndroidController@apiStoreProductOut')->name('api.apiStoreProductOut');
// Store product
Route::post('/apiStoreProduct','Api\ApiDataAndroidController@apiStoreProduct')->name('api.apiStoreProduct');
// Get all categories
Route::get('/apiGetAllCategories','Api\ApiDataAndroidController@apiGetAllCategories')->name('api.apiGetAllCategories');