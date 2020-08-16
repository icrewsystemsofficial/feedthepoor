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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/coming-soon', 'HomeController@comingsoon')->name('comingsoon');
Route::get('/logout', 'AdminController@logout');

Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/success', 'HomeController@success')->name('success');
Route::get('/error', 'HomeController@error')->name('error');
Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');

//DONATION ROUTES
Route::get('/money/{howmuch?}', 'PaymentsController@money')->name('donate.money');


Route::post('/process', 'PaymentsController@process')->name('donate.process.post');
Route::get('/process/{hash?}', 'PaymentsController@process')->name('donate.process.get');

Route::post('payments/verify', 'PaymentsController@verify')->name('payments.verify');

Route::get('/invoice/{invoice}/pay', 'PaymentsController@index')->name('payments.index');
Route::post('/request', 'PaymentsController@request');
Route::post('/response', 'PaymentsController@response');

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index');
    Route::get('/logout', 'AdminController@logout');

    Route::get('/donations', 'AdminController@donation');
});
