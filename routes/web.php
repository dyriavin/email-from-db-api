<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Email\EmailController;


Route::middleware('auth')->get('/', 'FrontController@indexHome');
Auth::routes();

Route::prefix('admin')
    ->middleware('auth')
    ->get('/credit-fund-active-user', function () {
    auth()->user()->credit()->update(['credit' => 20002]);

    return "was funded to current user";
});

Route::prefix('admin')->middleware('auth')
    ->get('/credit-zero-balance', function () {
    auth()->user()->credit()->update(['credit' => 0]);

    return "Balance Set to zero";
});

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::post('/api-key','GenerateKeyController@generateHashKey')
    ->name('api.key');

Route::get('/status/confirm/{id}','SenderEmailController@confirm')->name('sender.confirm');

Route::get('/status/decline/{id}','SenderEmailController@decline')->name('sender.decline');

Route::group([
    'namespace' => 'Email',
    'middleware' => ['auth']
], function () {
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
    Route::get('/history')->name('email.history');
});
Route::group([
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::get('/home', 'UserController@indexHome')
        ->name('user.index');
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {

    Route::prefix('admin')->get('/debug/env-jobs',function (){
        $data = \App\Http\Controllers\DebugController::index();
        return response($data);
    });
    Route::resource('admin', 'AdminController')
        ->names('admin');
    Route::post('/update-balance',
        'UserControlController@updateBalance')
        ->name('update.balance');
});
