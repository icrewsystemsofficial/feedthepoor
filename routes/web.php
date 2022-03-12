<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\Frontend\HomeController;
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


    Route::get('/activity', [HomeController::class, 'index'])->name('activity');
    Route::get('/campaigns', [HomeController::class, 'index'])->name('campaigns');
    Route::get('/track-donation/{donation_id?}', [HomeController::class, 'track_donation'])->name('track-donation');
    Route::get('/transparency-report', [HomeController::class, 'index'])->name('transparency-report');


    // STATIC PAGES

    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/volunteer', [HomeController::class, 'index'])->name('volunteer');
    Route::get('/faq', [HomeController::class, 'index'])->name('faq');
    Route::get('/contact', [HomeController::class, 'index'])->name('contact');
});

/*
  ------DASHBOARD ROUTES------
*/

Route::middleware(['auth'])->group(function () {
  Route::prefix('admin')->as('admin.')->group(function() {


      Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
      Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
      Route::post('/profile/save', [DashboardController::class, 'edit_profile'])->name('profile.save');


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

      });
          Route::prefix('users')->as('users.')->group(function() {
          Route::get('/{role}', [UsersController::class, 'index'])->name('index');
          Route::post('/create/{role}', [UsersController::class, 'create'])->name('create');
          Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])->name('destroy');

      });
  });
});


/*
  ------LARAVEL DEFAULT AUTHENTICATION ROUTES------
*/

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('admin.dashboard');

})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
