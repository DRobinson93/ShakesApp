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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'ShakeController@index')->name('home');

Route::prefix('shake')->group(function () {
    Route::post('create', 'ShakeController@create')->name('shake.create');
    Route::post('destroy', 'ShakeController@destroy')->name('shake.destroy');
    Route::get('{shake}', 'ShakeController@show');
    Route::get('create', 'ShakeController@showForm');
});
