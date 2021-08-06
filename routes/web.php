<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\SettingsModuleController;

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
        
Route::get('activity-logs', [SettingsController::class, 'activity'])->name('activity.logs');
     Route::get('/inivitation/{unique_code}', [SettingsController::class, 'create_user_inivitation'])->name('user.create');
    Route::put('/user-inivitation-create', [SettingsController::class, 'create_user_inivitation_create'])->name('user.create.password');
    Route::get('/donation', 'HomeController@donation')->name('donation');

    Route::prefix('admin')->group(function () {

        Route::prefix('/users')->group(function ()  {
            Route::get('/management', [SettingsController::class, 'user_module'])->name('user.fetch');
            Route::get('/edit/{id}',[SettingsController::class, 'user_edit'])->name('user.edit');
            Route::put('/user-edit', [SettingsController::class, 'update'])->name('user.update');
            Route::get('/delete/{id}', [SettingsController::class, 'delete'])->name('user.delete');
            Route::get('/management/create', [SettingsController::class, 'create_index'])->name('user.create.view');
            Route::put('/created', [SettingsController::class, 'create'])->name('user.create.new');
        
        });
        Route::prefix('/setting')->group(function ()  {
            Route::get('/', [SettingsModuleController::class, 'index'])->name('index');
            Route::post('/', [SettingsModuleController::class, 'settings_edit'])->name('edit');
            Route::post('/create', [SettingsModuleController::class, 'settings_create'])->name('setting.create');
            Route::post('/delete/{id}', [SettingsModuleController::class, 'settings_delete'])->name('delete');
            Route::post('/group-create', [SettingsModuleController::class, 'setting_group_create'])->name('group.create');            
        });
    
    });
    Route::get('/donation', 'DonationController@index');
