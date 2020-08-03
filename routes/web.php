<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', 'FrontController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::resource('user','UserController')->names('admin');
//    Route::get('/', 'HomeController@index')->name('home');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::resource('admin','AdminController')->names('admin');
//    Route::get('/', 'HomeController@index')->name('home');
});
