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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// log viewer
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


// api routes
Route::get('balance','APIController@appBalance')->name('app.balance');
Route::get('c2b','APIController@appC2BSTKPush')->name('app.c2b');
Route::get('b2c','APIController@appB2C')->name('app.b2c');
Route::get('express','APIController@expressPayment')->name('app.express');
