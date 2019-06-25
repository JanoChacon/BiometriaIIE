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
    return view('welcome');
});
Route::post('api-detect', 'ApiController@apiDetect');

Route::post('api-compare', 'ApiController@apiCompare');

Route::post('session-validate', 'ApiController@apiSession');

Route::post('faceset-create', 'ApiController@apiFacesetCreate');

Route::post('faceset-get', 'ApiController@apigetFacesets');

Route::post('faceset-delete', 'ApiController@apiFacesetDelete');

Route::post('face-add', 'ApiController@apiFacesetAddFace');

Route::post('face-delete', 'ApiController@apiFacesetDeleteFace');

Route::post('search-face', 'ApiController@apiSearchFace');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cuestionario', 'ApiController@index')->name('cuestionario')->middleware('auth');

Route::get('/facesetadmin', function () {
    return view('facesetadmin');
})->middleware('auth');
