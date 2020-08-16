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

// BASIC ROUTES
Route::get('/', 'HomeController@index')->name('index');
Route::get('/coming-soon', 'HomeController@comingsoon')->name('comingsoon');

Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/success', 'HomeController@success')->name('success');
Route::get('/error', 'HomeController@error')->name('error');

//DONATION ROUTES
Route::get('/money/{howmuch?}', 'PaymentsController@money')->name('donate.money');


Route::post('/process', 'PaymentsController@process')->name('donate.process.post');
Route::get('/process/{hash?}', 'PaymentsController@process')->name('donate.process.get');

Route::post('payments/verify', 'PaymentsController@verify')->name('payments.verify');

Route::get('/invoice/{invoice}/pay', 'PaymentsController@index')->name('payments.index');
Route::post('/request', 'PaymentsController@request');
Route::post('/response', 'PaymentsController@response');


Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
});
