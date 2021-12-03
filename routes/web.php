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

Route::get('/login', function () {
    return view('pages.login');
});