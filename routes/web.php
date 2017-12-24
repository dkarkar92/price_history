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

Route::resource('/', 'PriceHistory');
Route::post('price_history/store', "PriceHistory@store");

Route::get('price_history/graph', "PriceHistory@graph");

Route::get('/test', function () {
    return view('layouts/app');
})->middleware('auth');

/*Route::post('/home/submit', function () {
    return view('home');
});*/

Auth::routes();

//Route::get('/logout', 'LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');
