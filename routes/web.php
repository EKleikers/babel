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


//public APIs
Route::get('/api/v1', 'Auth\GuestAPIs@home');
Route::get('/api/login', 'Auth\GuestAPIs@login');
Route::get('/api/users/{username}', 'Auth\GuestAPIs@getusers');


Route::get('/test','OpenSeaController@test');

Auth::routes();
Auth::routes(['verify' => true]);

//BABEL-AI

//FRONTEND

// home
Route::get('/home','HomeController@index');
Route::get('/','HomeController@index');

// news
Route::get('/news', 'NewsController@showNews');

//MOBILE
Route::get('/test', 'APIController@test'); 

