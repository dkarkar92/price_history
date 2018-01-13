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

Route::resources([
    '/' => 'PriceHistory',
    '/users' => 'UserController',
    '/stores' => 'StoreController',
    '/summary' => 'SummaryController'
]);

Route::post('price_history/store', "PriceHistory@store");

Route::get('price_history/graph', "PriceHistory@graph");
Route::get('price_history/graph', "PriceHistory@graph");

//StoreController@addUserToStore
/*Route::get('/stores/add_user_to_store/{user_id}/{store_id}', function ($user_id, $store_id) {
    return 'User '. $user_id;
});*/
Route::post('/stores/add_user_to_store/{store_id}', "StoreController@addUserToStore");

Route::get('/test', function () {
    return view('layouts/app');
})->middleware('auth');

//return states json file
Route::get('/states.json', function () {
    return asset('js/states.json');
})->middleware('auth');

Auth::routes();

//Route::get('/logout', 'LoginController@logout');
//Route::get('/home', 'HomeController@index')->name('home');
/*Route::post('/home/submit', function () {
    return view('home');
});*/