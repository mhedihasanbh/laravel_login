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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/get-featured-products',[
    'uses'=>'App\Http\Controllers\APIController@getFeatureProducts',
    'as'=>'get-featured-products',
]);

Route::get('/get-best-look-product',[
    'uses'=>'App\Http\Controllers\APIController@getBestlookproduct',
    'as'=>'get-best-look-product',
]);
Route::get('/get-all-category',[
    'uses'=>'App\Http\Controllers\APIController@getAllCategory',
    'as'=>'get-all-category',
]);
//http://localhost/ecommerceweb/public/api/get-featured-products
//http://localhost/ecommerceweb/public/api/get-best-look-product
//http://localhost/ecommerceweb/public/api/get-all-category
