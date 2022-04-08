<?php

use App\Http\Controllers\API\FlutterAPIController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\API\RazorpayAPIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('api.v1.')->group(function() {
    Route::get('razorpay/create-order', [RazorpayAPIController::class, 'create_order'])->name('razorpay.create_order');
    Route::get('razorpay/payment-received/{payment_id?}', [RazorpayAPIController::class, 'payment_received'])->name('razorpay.payment_received');



    Route::prefix('flutter')->group(function() {


        Route::post('/authenticate', [FlutterAPIController::class, 'authenticate'])->name('authenticate');

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/user-details', [FlutterAPIController::class, 'user_details'])->name('user.details');
            Route::get('/app-details', [FlutterAPIController::class, 'app_details'])->name('app.details');
        });
    });



    /**
     * /authorize
     * /get-user-details
     * /get-user-status
     * /set-user-status
     *
     * /get-donation
     * /get-mission
     * /update-mission-status
     * /update-mission-objective-status
     * /upload-media
     * /get-media
     *
     *
     */
});
