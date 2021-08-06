<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use App\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('setting', function ($expression) {
            $expression = str_replace("'", "", $expression);
            $value = Setting::where('name', $expression)->first();
            return "$value->value";
        });
        Blade::directive('config', function ($expression) {
            $expression = str_replace("'", "", $expression);
            $value = Setting::where('name', $expression)->first();
            return "$value->value";
        });

       
            foreach (Setting::all() as $setting) {
                Config::set('settings.'.$setting->name, $setting->value);
            }
        
    }
    
}
