<?php

namespace App\Providers;

use Exception;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    /**
     * Rgister services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if(Schema::hasTable('setting')) {
            $core_settings = Setting::where('core', 1)->get();
            foreach($core_settings as $setting) {
                config(['setting.'.$setting->key.'' => $setting->value]);
            }
        } else {
            // dd('works');
        }
    }

     //The types of settings that we support.
     public const TEXT = '1';
     public const TEXTAREA = '2';
    //  public const RICHTEXT = '3';
    //  public const IMAGE = '4';
     public const BOOLEAN = '5';

     public static function types() : array {
         $types = array(
             self::TEXT => 'Input Box',
             self::TEXTAREA => 'Text Area',
            //  self::RICHTEXT => 'Rich Text editor',
            //  self::IMAGE => 'File',
             self::BOOLEAN => 'Switch',
         );

         return $types;
     }

     public function getType(int $type_input) {
         if($type_input == '') {
             throw new Exception('Setting type not provided');
         }

         foreach(self::types() as $type) {
             if($type_input == $type) {
                 return $type;
             }
         }

         //If there are no matches
         return new Exception('Unknown settings type');
     }
}
