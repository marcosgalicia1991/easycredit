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

Route::get('/', function () {
    //return view('welcome');
    return view('home');
});

Route::post('/login', 'LoginController@login');
Route::get('/login', 'LoginController@logged');
Route::get('/logout', 'LoginController@logout');
Route::get('/terms', 'OptionTermController@index');
Route::post('/request', 'RequestController@store');
Route::get('/request/{status}', 'UserRequestController@show');
Route::patch('/request/{id}', 'UserRequestController@destroy');
Route::get('/user', 'UserRequestController@index');