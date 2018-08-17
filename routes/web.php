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


Auth::routes();

Route::get('/', 'AdController@index');//все объявления

Route::get('/edit', 'AdController@edit');// создание объявления
Route::post('/edit', 'AdController@store');// создание объявления

Route::get('/{id}', 'AdController@show'); //просмотр объявления

Route::get('/edit/{id}', 'AdController@change');//редактирование объявления
Route::post('/edit/{id}', 'AdController@update');//редактирование объявления

Route::delete('/delete/{id}', 'AdController@destroy'); //удаление объявления