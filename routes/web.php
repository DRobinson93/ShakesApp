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
Route::get('/shake/{shake}/reaction/sumTxt', 'ShakeController@reactionSumTxt');
Route::get('/shake/{shake}/reaction', 'ShakeController@getUserReaction');

Route::post('shake/{shake}/reaction/store', 'ShakeReactionController@store')
    ->name('shake.reaction.store')
    ->middleware('auth');

Route::resource('shake', 'ShakeController');
