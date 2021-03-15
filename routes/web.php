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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'role'], function () {
    	Route::get('/room-911', 'Room911Controller@index')->name('room-911');
    	Route::delete('/employed/{id}', 'EmployedController@destroy')->name('destroy-employed');	
    	Route::put('/access/{id}', 'EmployedController@changeAccess')->name('changeAccess');
    	Route::post('/access-control', 'Room911Controller@accessControl')->name('access-control');	
    	Route::get('/history/{id}', 'EmployedController@history')->name('history');
    	Route::get('/export', 'EmployedController@export')->name('export');
    	Route::post('/bulk-employed', 'EmployedController@import')->name('bulk-employed');
    });
    
});
