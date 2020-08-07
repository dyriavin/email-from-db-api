<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Email\EmailController;


Route::get('/', 'FrontController@indexHome');
Auth::routes();
Route::middleware('auth')->get('/credit-fund',function (){
    auth()->user()->credit()->update(['credit'=> 20002]);
    return "OK";
});
Route::get('/home', 'HomeController@index')->name('home');
Route::group([
    'namespace' => 'Email'
],function (){
    Route::get('/email',
        'EmailController@index')
        ->name('email.index');

    Route::post('/email-search',
        'EmailController@submit')
        ->name('email.search');

    Route::get('/result',
        'EmailController@searchResults')
        ->name('email.result');

    Route::get('/export/{key?}/{from?}/{to?}',
        'ExportController@export')
        ->name('csv-export');

});
Route::group([
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
//    Route::get('/home', 'UserController@ind')->name('user.index');
    Route::get('/home', 'UserController@indexHome')->name('user.index');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {
    Route::resource('admin', 'AdminController')->names('admin');
});
