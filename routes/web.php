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

/*Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::put('post/{id}', function ($id){
   //
})->middleware('auth', 'role:admin');

Route::resource('properties', 'PropertyController')->middleware('auth', 'role:admin');

Route::delete('properties/{id}', 'PropertyController@destroy');

Route::resource('publications', 'PublicationsController')->middleware('auth', 'role:admin');

Route::delete('publications/{id}', 'PublicationsController@destroy');

Route::resource('users', 'UserController')->middleware('auth', 'role:admin');

Route::delete('users/{id}', 'UserController@destroy');

Route::resource('offers', 'OffersController')->middleware('auth', 'role:admin');
