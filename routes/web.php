<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
Use App\Http\Controllers\SizeController;
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

Route::get('/delete-category/{id}',[
    'uses'=>'App\Http\Controllers\CategoryController@categoryDelete',
    'as'=>'delete-category',
    'middleware'=>['auth:sanctum', 'verified']

]);


/*---  Category Route End *----*/

/*---  Sub-Category Route Start *----*/
Route::get('/manage-sub-category',[

    'uses'=>'App\Http\Controllers\SubCategoryController@index',
    'as'=>'manage-sub-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/new-sub-category',[
    'uses'=>'App\Http\Controllers\SubCategoryController@create',
    'as'=>'new-sub-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/update-sub-category-status/{id}',[
    'uses'=>'App\Http\Controllers\SubCategoryController@updateStatus',
    'as'=>'update-sub-category-status',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/edit-sub-category/{id}',[
    'uses'=>'App\Http\Controllers\SubCategoryController@categoryEdit',
    'as'=>'edit-sub-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-sub-category',[
    'uses'=>'App\Http\Controllers\SubCategoryController@categoryupdate',
    'as'=>'update-sub-category',
    'middleware'=>['auth:sanctum', 'verified']

]);

Route::get('/delete-sub-category/{id}',[
    'uses'=>'App\Http\Controllers\SubCategoryController@subDelete',
    'as'=>'delete-sub-category',
    'middleware'=>['auth:sanctum', 'verified']

]);
/*---  Sub-Category Route End *----*/
/*---  Brand Route Start *----*/
Route::get('/manage-brand',[

    'uses'=>'App\Http\Controllers\BrandController@index',
    'as'=>'manage-brand',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/new-brand',[
    'uses'=>'App\Http\Controllers\BrandController@create',
    'as'=>'new-brand',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/update-brand-status/{id}',[
    'uses'=>'App\Http\Controllers\BrandController@updateStatus',
    'as'=>'update-brand-status',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/edit-brand/{id}',[
    'uses'=>'App\Http\Controllers\BrandController@brandEdit',
    'as'=>'edit-brand',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-brand',[
    'uses'=>'App\Http\Controllers\BrandController@categoryupdate',
    'as'=>'update-brand',
    'middleware'=>['auth:sanctum', 'verified']

]);

Route::get('/delete-brand/{id}',[
    'uses'=>'App\Http\Controllers\BrandController@categoryDelete',
    'as'=>'delete-brand',
    'middleware'=>['auth:sanctum', 'verified']
]);
/*---  Brand Route End *----*/
/*---  Unit Route Start*----*/
Route::get('/manage-unit',[

    'uses'=>'App\Http\Controllers\UnitController@index',
    'as'=>'manage-unit',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/new-unit',[
    'uses'=>'App\Http\Controllers\UnitController@create',
    'as'=>'new-unit',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/update-unit-status/{id}',[
    'uses'=>'App\Http\Controllers\UnitController@updateStatus',
    'as'=>'update-unit-status',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/edit-unit/{id}',[
    'uses'=>'App\Http\Controllers\UnitController@unitEdit',
    'as'=>'edit-unit',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-unit',[
    'uses'=>'App\Http\Controllers\UnitController@unitupdate',
    'as'=>'update-unit',
    'middleware'=>['auth:sanctum', 'verified']

]);

Route::get('/delete-unit/{id}',[
    'uses'=>'App\Http\Controllers\UnitController@unitDelete',
    'as'=>'delete-unit',
    'middleware'=>['auth:sanctum', 'verified']
]);

/*---  UNIt Route End *----*/

/*--- Color Route start *----*/
Route::resource('/color',ColorController::class);

Route::get('/update-color-status/{id}',[
    'uses'=>'App\Http\Controllers\UnitController@updateStatus',
    'as'=>'update-color-status',
    'middleware'=>['auth:sanctum', 'verified']

]);

/*---  Color Route End *----*/

/*--- Size Route start *----*/
Route::resource('/size',SizeController::class);

Route::get('/update-size-status/{id}',[
    'uses'=>'App\Http\Controllers\SizeController@updateStatus',
    'as'=>'update-size-status',
    'middleware'=>['auth:sanctum', 'verified']

]);

/*---Size Route End *----*/
/*---Product Route Start*----*/
Route::get('/add-product',[

    'uses'=>'App\Http\Controllers\ProductController@index',
    'as'=>'add-product',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/get-sub-category-by-category-id',[

    'uses'=>'App\Http\Controllers\ProductController@getSubcategoryByCategory',
    'as'=>'get-sub-category-by-category-id',
    'middleware'=>['auth:sanctum', 'verified']

]);


Route::post('/new-product',[
    'uses'=>'App\Http\Controllers\ProductController@create',
    'as'=>'new-product',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/manage-product',[

    'uses'=>'App\Http\Controllers\ProductController@manage',
    'as'=>'manage-product',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/update-product-status/{id}',[
    'uses'=>'App\Http\Controllers\ProductController@updateStatus',
    'as'=>'update-product-status',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::get('/view-product-details/{id}',[
    'uses'=>'App\Http\Controllers\ProductController@viewdetails',
    'as'=>'view-product-details',
    'middleware'=>['auth:sanctum', 'verified']

]);


Route::get('/edit-product/{id}',[
    'uses'=>'App\Http\Controllers\ProductController@productEdit',
    'as'=>'edit-product',
    'middleware'=>['auth:sanctum', 'verified']

]);
Route::post('/update-product',[
    'uses'=>'App\Http\Controllers\ProductController@productUpdate',
    'as'=>'update-product',
    'middleware'=>['auth:sanctum', 'verified']

]);

Route::get('/delete-product/{id}',[
    'uses'=>'App\Http\Controllers\ProductController@productDelete',
    'as'=>'delete-product',
    'middleware'=>['auth:sanctum', 'verified']
]);


/*---Product Route End *----*/












Route::get('/dashboard',[
    'uses'=>'App\Http\Controllers\DashboardController@index',
    'as'=>'dashboard',
    'middleware'=>['auth:sanctum', 'verified']

]);



//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
