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

Route::get('product',"api\\productController@index");
Route::get('category',"api\\categoryController@index");

Route::get('menu',"api\\menuController@index");
Route::get('company',"api\\menuController@company");


Route::get('client',"api\\clientController@index");


Route::get('product/ById',"api\\productController@byId");


Route::get('category/ById',"api\\categoryController@byId");
Route::get('menu/ById',"api\\menuController@byId");
Route::get('client/ById',"api\\clientController@byId");

Route::get('product/ByAtt',"api\\productController@ByAtt");
Route::get('product/random',"api\\productController@randomSearch");

Route::get('city',"api\\productController@city");


