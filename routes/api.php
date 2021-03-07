<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::prefix('mobile')->group(function () {

        Route::get('/', 'API\Mobile@index');
        Route::get('/token/{email}', 'API\Mobile@getToken')->name('token.generate.withEmail');
        Route::post('/authenticate', 'API\Mobile@authenticate')->name('authenticate.GenerateToken');

        Route::middleware('auth:sanctum')->group( function(){
            Route::get('/test', 'API\Mobile@index');

            Route::get('/pending-donations/{ngo_id}', 'API\Mobile@index')->name('pendindDonations');

            Route::get('/get-donation/{donation_id}', 'API\Mobile@index')->name('getDonation');

            Route::post('/upload-image/{donation_id}/{picture_name}/{ngo_id}', 'API\Mobile@index')->name('uploadImage');
        });



    });
});

Route::get('convert/{base}/{end}/{amount}', 'PaymentsController@convert');
Route::post('verify', 'HomeController@testimonialVerify');
Route::post('admin/testimonials/status','AdminController@testimonialstatus');
Route::post('admin/testimonials/approve','AdminController@approvetestimonials');
Route::post('admin/testimonials/delete','AdminController@deletetestimonial');
Route::post('admin/testimonials/restore','AdminController@restoretestimonial');
