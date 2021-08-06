<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingGroup;
use App\Setting;
use App\Helpers\SettingsHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Http\Requests\StoreSettingRequest;
use App\Notifications\GeneralNotification;

class SettingsModuleController extends Controller
{
   
    public function index(){
        $settings = Setting::get()->all();
        return view('settings.settings', [
            'setting_groups' => SettingGroup::all(),
        ]);
    }

   public function settings_edit(Request $request)
    {

        foreach($request->input() as $input => $value) {
            if($input != '_token') {
                $setting = Setting::where('name', $input)->first();
                $setting->value = $value;
                $setting->update();
            }
        }

        //If the settings has files.
        foreach($request->file() as $file => $value) {

            // Step 1, Upload.
            $request->validate([
                $file => ['image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            ]);

            $image = $request->file($file);
            $fileInfo = $image->getClientOriginalName();
            $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
            $file_name = $filename. '-'. time() .'.'.$extension;

            $save_path = 'storage/setting-images';
            $image->move(public_path($save_path), $file_name);

            //Step 2, Update on DB.
            $setting = Setting::where('name', $file)->first();

            // Storage::delete(public_path($setting->value));
            Storage::delete(str_replace('storage/', '', $setting->value));
            // dd($setting->value);

            $setting->value = $save_path.'/'.$file_name;

            $setting->update();

        }





        //Toast::success('Yay!','Settings updated successfully');
      return redirect()->back();
    }

    
    public function settings_create(Request $request)
    {
        $validatedData =  $request->validate([
            'key' => ['required','unique:settings'],
            'name' => ['required'],
            'type' => ['required'],
            'group' => ['required'],
            'core' => ['required'],
            'description' => ['required'],
          ]);
        
      Setting::create($validatedData);
      
       activity('admin')->log('Settings module: '.Auth::user()->name.' created '.$request->name.' setting');


       //Toast::success('Yay!','New setting added successfully');

       return redirect()->back();
    }

    public function setting_group_create(Request $request)
    {
       SettingGroup::create([
           'name' => $request->name,
           'description' => $request->description
       ]);

       activity('admin')->log('Settings module: '.Auth::user()->name.' created '.$request->name.' group');

       //Toast::success('Yay!','New setting group created successfully');

       return redirect()->back();
    }

public function settings_delete($id)
    {
        $setting = Setting::find($id);
        dd($setting);
        $setting->delete();

        activity('admin')->log('Settings module: '.Auth::user()->name.' deleted '.$setting->name.' setting');

        Toast::info('Yay!','Setting deleted');

    }
}
