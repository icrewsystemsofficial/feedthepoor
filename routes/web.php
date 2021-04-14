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

Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('/who-did-we-feed-today', 'FrontendController@whoDidWeFeedToday')->name('frontend.whoDidWeFeedToday');
Route::get('/about', 'FrontendController@about')->name('frontend.about');
Route::get('/how-does-it-work', 'FrontendController@howDoesItWork')->name('frontend.howDoesItWork');
Route::get('/volunteers', 'FrontendController@volunteers')->name('frontend.volunteers');
Route::get('/partners', 'FrontendController@partners')->name('frontend.partners');
Route::get('/testimonials', 'FrontendController@testimonials')->name('frontend.testimonials');
Route::get('/gallery', 'FrontendController@gallery')->name('frontend.gallery');

Route::prefix('/dashboard')->group(function () {
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/testimonial', 'TestimonialController@index')->name('testimonial');
    Route::get('/testimonial/create', 'TestimonialController@create')->name('testimonials.create');
    Route::POST('/testimonial/store', 'TestimonialController@store')->name('testimonials.store');
    Route::put('/testimonial/show', 'TestimonialController@show')->name('testimonials.show');

    Route::get('/testimonial/{testimonial}/edit', 'TestimonialController@edit')->name('testimonials.edit');

    Route::put('/testimonial/{testimonial}', [TestimonialController::class,'update']);

    
    Route::delete('/testimonial/{testimonial}', 'TestimonialController@destroy')->name('testimonials.destroy');





    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

});



