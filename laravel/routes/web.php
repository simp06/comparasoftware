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
Route::get('/compara', 'ComparaController@index')->name('home');
Route::get('/admin', function () {
    return view('coreui.homepage');
});

//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

/*
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::post('logout', 'AuthController@logout');
*/