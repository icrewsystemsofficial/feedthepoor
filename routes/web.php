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

Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');

Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/success', 'HomeController@success')->name('success');
Route::get('/error', 'HomeController@error')->name('error');
Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/work', 'HomeController@work')->name('work');
Route::get('/volunteers', 'HomeController@volunteers')->name('volunteers');
Route::get('/partners', 'HomeController@partners')->name('partners');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/today', 'HomeController@today')->name('today');







//DONATION ROUTES
Route::get('/money/{howmuch?}', 'PaymentsController@money')->name('donate.money');


Route::post('/process', 'PaymentsController@process')->name('donate.process.post');
Route::get('/process/{hash?}', 'PaymentsController@process')->name('donate.process.get');

Route::post('payments/verify', 'PaymentsController@verify')->name('payments.verify');

Route::get('/invoice/{invoice}/pay', 'PaymentsController@index')->name('payments.index');
Route::post('/request', 'PaymentsController@request');
Route::post('/response', 'PaymentsController@response');


Auth::routes();
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', 'AdminController@index');
    Route::get('/logout', 'AdminController@logout');

    Route::get('/donations', 'AdminController@donation');
    Route::get('/mailer', 'AdminController@mailer');
    Route::post('/sendmail', 'AdminController@sendmail');

    //created by SAURABH, to add manual donations
    Route::get('/add', 'AdminController@add')->name('add');
    Route::post('add/manual', 'AdminController@manual')->name('manual');
});
