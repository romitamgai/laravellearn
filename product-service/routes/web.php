<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('products', function () {
//    return App\product::all();
//});

Route::group(['prefix'=>'api'],function(){
//    Route::get('products',['as'=>'products',function(){
//        return App\product::all();
//    }]);
    Route::resource('products','ProductController',['only'=>['index','store','update']]);
    Route::resource('products.descriptions','ProductDescriptionController',['only'=>['index','store']]);
});