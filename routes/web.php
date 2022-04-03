<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\CausesController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CampaignsController;
use App\Http\Controllers\Admin\DonationsController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


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

    Route::get('/campaigns', [HomeController::class, 'index'])->name('campaigns');
    Route::get('/track-donation/{donation_id?}', [HomeController::class, 'track_donation'])->name('track-donation');
    Route::get('/transparency-report', [HomeController::class, 'index'])->name('transparency-report');


    // STATIC PAGES

    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
    Route::get('/faq', [HomeController::class, 'index'])->name('faq');
    Route::get('/contact', [HomeController::class, 'index'])->name('contact');
});

/*
  ------DASHBOARD ROUTES------
*/

Route::prefix('admin')->as('admin.')->group(function () {


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/save', [DashboardController::class, 'edit_profile'])->name('profile.save');


    Route::prefix('location')->as('location.')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::get('/manage/{id}', [LocationController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [LocationController::class, 'destroy'])->name('destroy');
        Route::put('/update/{id}', [LocationController::class, 'update'])->name('update');
        Route::post('/store', [LocationController::class, 'store'])->name('store');
    });

    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/create', [SettingsController::class, 'create'])->name('create');
        Route::post('/update', [SettingsController::class, 'update'])->name('update');

        Route::post('/group/create', [SettingsController::class, 'group_save'])->name('group.create');
        Route::post('/group/{id}/update', [SettingsController::class, 'group_update'])->name('group.update');
        Route::post('/group/{id}/delete', [SettingsController::class, 'group_delete'])->name('group.delete');


        # Activity logs
        Route::get('/activity', [SettingsController::class, 'activity_logs'])->name('activity');
    });

    Route::prefix('faq')->as('faq.')->group(function () {
        Route::prefix('questions')->as('questions.')->group(function () {
            Route::get('/', [FaqController::class, 'index'])->name('index');
            Route::get('/manage/{id}', [FaqController::class, 'manage'])->name('manage');
            Route::delete('/destroy/{id}', [FaqController::class, 'destroy'])->name('destroy');
            Route::put('/update/{id}', [FaqController::class, 'update'])->name('update');
            Route::post('/store', [FaqController::class, 'store'])->name('store');
        });
        Route::prefix('categories')->as('categories.')->group(function () {
            Route::get('/', [FaqController::class, 'categories'])->name('index');
            Route::get('/manage/{id}', [FaqController::class, 'category_manage'])->name('manage');
            Route::delete('/destroy/{id}', [FaqController::class, 'category_destroy'])->name('destroy');
            Route::put('/update/{id}', [FaqController::class, 'category_update'])->name('update');
            Route::post('/store', [FaqController::class, 'category_store'])->name('store');
        });
    });

    Route::prefix('causes')->as('causes.')->group(function () {
        Route::get('/', [CausesController::class, 'index'])->name('index');
        Route::post('/store', [CausesController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CausesController::class, 'update'])->name('update');
        Route::get('/manage/{id}', [CausesController::class, 'manage'])->name('manage');
        Route::delete('/destroy/{id}', [CausesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('campaigns')->as('campaigns.')->group(function () {
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
});

/*
  ------LARAVEL DEFAULT AUTHENTICATION ROUTES------
*/

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
