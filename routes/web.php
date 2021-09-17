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
})->name('home');

Route::get('/car-requests', 'RequestedCarController@index')->name('car-requests.index');
Route::get('/car-requests/create', 'RequestedCarController@create')->name('car-requests.create');
Route::post('/car-requests', 'RequestedCarController@store')->name('car-requests.store');
