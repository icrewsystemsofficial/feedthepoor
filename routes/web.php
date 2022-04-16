<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CausesController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MissionsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\CampaignsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationsController;
use App\Http\Controllers\Admin\OperationsController;


/*

  ______            _ _______ _          _____
 |  ____|          | |__   __| |        |  __ \
 | |__ ___  ___  __| |  | |  | |__   ___| |__) |__   ___  _ __
 |  __/ _ \/ _ \/ _` |  | |  | '_ \ / _ \  ___/ _ \ / _ \| '__|
 | | |  __/  __/ (_| |  | |  | | | |  __/ |  | (_) | (_) | |
 |_|  \___|\___|\__,_|  |_|  |_| |_|\___|_|   \___/ \___/|_|

 An initiative by ICREWSYSTEMS SOFTWARE ENGINEERING LLP.
*/


/*
  ------FRONTEND ROUTES------
*/



Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');


    // DYNAMIC PAGES

    Route::get('/donate', [HomeController::class, 'donate'])->name('donate');
    Route::get('/donate/process/{razorpay_order_id?}', [HomeController::class, 'donate_process'])->name('donate.process');

    Route::get('/thank-you/{donation_id?}', [HomeController::class, 'thank_you'])->name('donate.thank_you');

    # As of now, this only accepts RAZORPAY PAYMENT ID, which is quite hard to "guess"
    # If we have it as donation ID, people will go around guessing numbers and
    # if they get access to someone else's donation receipt, we might leak their address, which is a
    # MAJOR problem.
    Route::get('/receipt/{id?}', [HomeController::class, 'receipt'])->name('donations.receipt');


    Route::get('/campaigns', [HomeController::class, 'index'])->name('campaigns');
    Route::get('/track-donation/{donation_id?}', [HomeController::class, 'track_donation'])->name('track-donation');
    Route::get('/transparency-report', [HomeController::class, 'index'])->name('transparency-report');


    // STATIC PAGES

    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/partners', [HomeController::class, 'partners'])->name('partners');
    Route::get('/volunteer', [HomeController::class, 'index'])->name('volunteer');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'savecontact'])->name('savecontact');
});

/*
  ------DASHBOARD ROUTES------
*/

Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/save', [DashboardController::class, 'edit_profile'])->name('profile.save');

    Route::prefix('profile')->as('profile.')->group(function() {
        Route::get('view/{id}', [UsersController::class, 'view'])->name('view');
        Route::post('{id}/update', [UsersController::class, 'update'])->name('update');
        Route::post('{id}/password_update', [UsersController::class, 'update_password'])->name('password_update');
    });

    Route::prefix('location')->as('location.')->group(function() {
        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::get('/manage/{id}', [LocationController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [LocationController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [LocationController::class, 'update'])->name('update');
        Route::post('/store', [LocationController::class, 'store'])->name('store');
    });

    Route::prefix('settings')->as('settings.')->group(function() {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/create', [SettingsController::class, 'create'])->name('create');
        Route::post('/update', [SettingsController::class, 'update'])->name('update');

        Route::post('/group/create', [SettingsController::class, 'group_save'])->name('group.create');
        Route::post('/group/{id}/update', [SettingsController::class, 'group_update'])->name('group.update');
        Route::post('/group/{id}/delete', [SettingsController::class, 'group_delete'])->name('group.delete');

        # Activity logs
        Route::get('/activity', [SettingsController::class, 'activity_logs'])->name('activity');
    });


    Route::prefix('users')->as('users.')->group(function() {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/manage/{id}', [UsersController::class, 'manage'])->name('manage');
        Route::post('/create', [UsersController::class, 'create'])->name('create');
        Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('faq')->as('faq.')->group(function() {
        Route::prefix('questions')->as('questions.')->group(function() {
            Route::get('/', [FaqController::class, 'index'])->name('index');
            Route::get('/manage/{id}', [FaqController::class, 'manage'])->name('manage');
            Route::delete('/destroy/{id}', [FaqController::class, 'destroy'])->name('destroy');
            Route::put('/update/{id}', [FaqController::class, 'update'])->name('update');
            Route::post('/store', [FaqController::class, 'store'])->name('store');
        });
        Route::prefix('categories')->as('categories.')->group(function() {
            Route::get('/', [FaqController::class, 'categories'])->name('index');
            Route::get('/manage/{id}', [FaqController::class, 'category_manage'])->name('manage');
            Route::delete('/destroy/{id}', [FaqController::class, 'category_destroy'])->name('destroy');
            Route::put('/update/{id}', [FaqController::class, 'category_update'])->name('update');
            Route::post('/store', [FaqController::class, 'category_store'])->name('store');
        });
    });

    Route::prefix('causes')->as('causes.')->group(function() {
        Route::get('/', [CausesController::class, 'index'])->name('index');
        Route::post('/store', [CausesController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CausesController::class, 'update'])->name('update');
        Route::get('/manage/{id}', [CausesController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [CausesController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('contact')->as('contact.')->group(function () {
        Route::get('/', [ContactsController::class, 'index'])->name('index');
        Route::get('/view/{id}', [ContactsController::class, 'viewContact'])->name('view');
        Route::delete('/delete/{id}', [ContactsController::class, 'deleteContact'])->name('delete');
        Route::post('/spam/{id}', [ContactsController::class, 'mark_Spam'])->name('spam');
        Route::post('/contacted/{id}', [ContactsController::class, 'mark_Contacted'])->name('contacted');
    });

    Route::prefix('campaigns')->as('campaigns.')->group(function() {
        Route::get('/', [CampaignsController::class, 'index'])->name('index');
        Route::post('/store', [CampaignsController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CampaignsController::class, 'update'])->name('update');
        Route::get('/manage/{id}', [CampaignsController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [CampaignsController::class, 'destroy'])->name('destroy');
        Route::post('/upload', [CampaignsController::class, 'upload'])->name('upload');
    });

    Route::prefix('donations')->as('donations.')->group(function () {
        Route::get('/', [DonationsController::class, 'index'])->name('index');
        Route::post('/store', [DonationsController::class, 'store'])->name('store');
        Route::get('/manage/{id}', [DonationsController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [DonationsController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [DonationsController::class, 'update'])->name('update');
    });

    Route::prefix('operations')->as('operations.')->group(function(){
        Route::prefix('procurement')->as('procurement.')->group(function(){
            Route::get('/', [OperationsController::class, 'procurement_index'])->name('index');
            Route::post('/update/{id}', [OperationsController::class, 'procurement_update'])->name('update');
        });

        Route::delete('/destroy/{id}', [OperationsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('missions')->as('missions.')->group(function() {
        Route::get('/', [MissionsController::class, 'index'])->name('index');
        Route::get('/manage/{id}', [MissionsController::class, 'view'])->name('manage');
        Route::post('/store', [MissionsController::class, 'store'])->name('store');
        Route::post('/update/{id}', [MissionsController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [MissionsController::class, 'destroy'])->name('destroy');
    });

});

Route::prefix('admin/jobs')->group(function () {
    # The views of this package cannot take in "name" arguments
    # hence it's routes are isolated.
    Route::queueMonitor();
});


/*
  ------LARAVEL DEFAULT AUTHENTICATION ROUTES------
*/
Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/test', function () {
    return view('pdf.receipts.receipt');
});

require __DIR__ . '/auth.php';
