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
    return view('pages.welcome');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

Route::get('/crud-list', 'App\Http\Controllers\CrudController@list')->name('list');

Route::post('/delete-crud', 'App\Http\Controllers\CrudController@delete');
Route::post('/add-crud-data', 'App\Http\Controllers\CrudController@add');
Route::post('/get-crud-record', 'App\Http\Controllers\CrudController@getRecoredByID');
Route::post('/update-crud-data', 'App\Http\Controllers\CrudController@update');
Route::get('/get-crud-list', 'App\Http\Controllers\CrudController@getList');

//products crud
Route::get('/product-list', 'App\Http\Controllers\ProductController@list')->name('list');
Route::post('/delete-product', 'App\Http\Controllers\ProductController@delete');
Route::post('/add-product-data', 'App\Http\Controllers\ProductController@add');
Route::post('/get-product-record', 'App\Http\Controllers\ProductController@getRecoredByID');
Route::post('/update-product-data', 'App\Http\Controllers\ProductController@update');
Route::get('/get-product-list', 'App\Http\Controllers\ProductController@getList');

//categories crud
Route::get('/category-list', 'App\Http\Controllers\CategoryController@list')->name('list');
Route::post('/delete-category', 'App\Http\Controllers\CategoryController@delete');
Route::post('/add-category-data', 'App\Http\Controllers\CategoryController@add');
Route::post('/get-category-record', 'App\Http\Controllers\CategoryController@getRecoredByID');
Route::post('/update-category-data', 'App\Http\Controllers\CategoryController@update');
Route::get('/get-category-list', 'App\Http\Controllers\CategoryController@getList');

Route::get('/login', function () {
    return view('pages.login');
});

Route::resource('schools', 'App\Http\Controllers\SchoolController');
