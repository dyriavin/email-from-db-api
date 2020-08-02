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

Route::get('/', 'FrontController@index');

Route::group(['namespace' => 'Admin'],function (){
    Route::resource('admin','AdminController')->middleware('auth')->names('admin');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
