<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('activity-logs', [SettingsController::class, 'activity'])->name('activity-logs');

// From here

    Route::get('/edit/{id}',[SettingsController::class, 'user_edit'])->name('user.edit');
    Route::put('/user-edit', [SettingsController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('user.delete');
    Route::get('/user-management-create', [SettingsController::class, 'create_index'])->name('user.create.view');
    Route::put('/user-created', [SettingsController::class, 'create'])->name('user.create.new');
    Route::get('/user-inivitation/{unique_code}', [SettingsController::class, 'create_user_inivitation'])->name('user.create');
    Route::put('/user-inivitation-create', [SettingsController::class, 'create_user_inivitation_create'])->name('user.create.password');

//To Here

Route::prefix('user')->group(function () {
    Route::get('/', [SettingsController::class, 'user_module'])->name('user.fetch');

});

/**
 * Route Format:
 *
 * / => management
 * /edit => edit
 * /create => create
 * /create
 * /created
 * /invitation
 * /invitation/create
 * ...
 */




