<?php

use App\Http\Controllers\API\RazorpayAPIController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('api.v1.')->group(function() {
    Route::get('razorpay/create-order', [RazorpayAPIController::class, 'create_order'])->name('razorpay.create_order');
    Route::get('razorpay/payment-received/{payment_id?}', [RazorpayAPIController::class, 'payment_received'])->name('razorpay.payment_received');
});
