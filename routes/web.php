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
Route::group(['middleware' => 'cors'], function(){

});

Route::get('/', function () {
    return view('welcome');
});
Route::get('apicall','ApiController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/cuestionario', function () {
    return view('cuestionario');
});




