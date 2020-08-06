<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Email\EmailController;


Route::get('/', 'FrontController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'namespace' => 'Email'
],function (){
    Route::get('/search-email', 'EmailController@index')->name('email-form.index');

});
Route::group([
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::get('/home', 'UserController@index')->name('user.index');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::resource('admin', 'AdminController')->names('admin');
});
