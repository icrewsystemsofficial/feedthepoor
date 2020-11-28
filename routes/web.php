<?php

use App\Http\Controllers\HomeController;
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
Route::get('/mission', 'HomeController@mission')->name('mission');

//Testing the deployer.
// Route::get('deploy', 'DeployController@index');

Route::post('/volunteerssuccess', 'HomeController@volunteerssuccess')->name('volunteerssuccess');
Route::post('/partnerssuccess', 'HomeController@partnerssuccess')->name('partnerssuccess');
Route::post('/contactsuccess', 'HomeController@contactsuccess')->name('contactsuccess');
Route::post('/testimonialsuccess', 'HomeController@testimonialsuccess')->name('testimonialsuccess');

Route::get('/downloadRecipt/{payment_id}', 'PaymentsController@downloadRecipt');

Route::get('/test', function () {
  Illuminate\Support\Facades\Mail::to('kashrayks@gmail.com')->send(new App\Mail\Test('pay_FT9tQdRmnYxpbx'));
});

Route::get('/logout', 'AdminController@logout');

Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');

Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/success', 'HomeController@success')->name('success');
Route::get('/error', 'HomeController@error')->name('error');
Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');
Route::get('/testimonials/add', 'HomeController@addtestimonial')->name('testimonials.add');
Route::get('/testimonials/view/{slug}', 'HomeController@viewtestimonial')->name('testimonials.view');
Route::get('/work', 'HomeController@work')->name('work');
Route::get('/volunteers', 'HomeController@volunteers')->name('volunteers');
Route::get('/partners', 'HomeController@partners')->name('partners');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/who-did-we-feed-today','HomeController@donationgallery')->name('donationgallery');
Route::get('/who-did-we-feed-today/search-results','HomeController@donationsearch')->name('search');
Route::get('/who-did-we-feed-today/{data}','HomeController@show')->name('show');




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
    Route::get('/donations/details/{id}', 'AdminController@donation_details');
    Route::get('/donations/razorpay', 'AdminController@razorpay');
    Route::get('/mailer', 'AdminController@mailer');
    Route::post('/sendmail', 'AdminController@sendmail');

    Route::get('/testimonials', 'AdminController@testimonials');
    Route::get('/testimonials/unapproved', 'AdminController@unapprovedtestimonials');
    Route::get('/testimonials/deleted', 'AdminController@deletedtestimonials');

    //created by SAURABH, to add manual donations
    Route::get('/add', 'AdminController@add')->name('add');
    Route::post('add/manual', 'AdminController@manual')->name('manual');
});
