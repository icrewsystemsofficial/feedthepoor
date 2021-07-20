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
Route::get('/user-management', [SettingsController::class, 'user_module'])->name('user.fetch');
    Route::get('/edit/{id}',[SettingsController::class, 'user_edit'])->name('user.edit');
    Route::put('/user-edit', [SettingsController::class, 'update'])->name('user.update');
    Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('user.delete');

