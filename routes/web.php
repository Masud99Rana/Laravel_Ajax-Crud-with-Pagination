<?php

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




// ajax
Route::get('/customer', 'CustomerController@home');
Route::get('get/customer/data', 'CustomerController@getdata');
Route::post('add/customer/data', 'CustomerController@add');
Route::post('update/customer/data', 'CustomerController@update');

Route::get('view/customer/data', 'CustomerController@viewdata');
Route::get('delete/customer/data', 'CustomerController@deletedata');
Route::get('edit/customer/data', 'CustomerController@editurl');
Route::get('get/customer/data/by/pagination', 'CustomerController@getpagination');