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

Route::get('/',[
    'uses'=>'App\Http\Controllers\LoginController@login',
    'as'=>'Home',
    'middleware'=>['login']
]);
/*---  Category Route Start *----*/
Route::get('/manage-category',[
    'uses'=>'App\Http\Controllers\CategoryController@index',
    'as'=>'manage-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/new-category',[
    'uses'=>'App\Http\Controllers\CategoryController@create',
    'as'=>'new-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/update-category-status/{id}',[
    'uses'=>'App\Http\Controllers\CategoryController@updateStatus',
    'as'=>'update-category-status',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/edit-category/{id}',[
    'uses'=>'App\Http\Controllers\CategoryController@categoryEdit',
    'as'=>'edit-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-category',[
    'uses'=>'App\Http\Controllers\CategoryController@categoryupdate',
    'as'=>'update-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-category',[
    'uses'=>'App\Http\Controllers\CategoryController@categoryupdate',
    'as'=>'update-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/delete-category/{id}',[
    'uses'=>'App\Http\Controllers\CategoryController@categoryDelete',
    'as'=>'delete-category',
    'middleware'=>['auth:sanctum', 'verified']

]);









/*---  Category Route End *----*/





Route::get('/dashboard',[
    'uses'=>'App\Http\Controllers\DashboardController@index',
    'as'=>'dashboard',
    'middleware'=>['auth:sanctum', 'verified']

]);



//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
