<?php
 namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Setting;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        $settings = array(
            array(
            'name' => 'APP_NAME',
            'description' => 'This is the application name.',
            'value' => 'Feed The Poor',
            'type' => '2',
            'core' => '1',
            'group' => '1',
            'order' => '1',
        ),
            array(
            'name' => 'APP_LOGO',
            'description' => 'This is the application logo.',
            'value' => 'settings/logo.png',
            'type' => '4',
            'core' => '1',
            'group' => '1',
            'order' => '2',
            ),
            array(
                'name' => 'APP_DESCRIPTION',
                'description' => 'This is the application description.',
                'value' => 'Feed The Poor is a donating food for needed, created with love by icrewsystems',
                'type' => '2',
                'core' => '1',
                'group' => '1',
                'order' => '2',
            ),
            array(
                'name' => 'USER_ACCEPT_REGISTRATION',
                'description' => 'Should the app automatically accept user registrations?.',
                'value' => '0',
                'type' => '5',
                'core' => '1',
                'group' => '2',
                'order' => '1',
            ),
            array(
                'name' => 'SEND_SELF_DIAGONSIS_REPORT',
                'description' => 'If enabled sends failed self diagnosis report to the admins',
                'value' => '1',
                'type' => '5',
                'core' => '1',
                'group' => '3',
                'order' => '1',
            )
          );

          foreach($settings as $request) {

            $request = (object) $request;

            $setting = new Setting;
            $setting->key = $request->name;
            $setting->name = $request->name;
            $setting->description = $request->description;
            $setting->value = $request->value;
            $setting->type = $request->type;
            $setting->core = $request->core;
            $setting->group = $request->group;
            $setting->order = $request->order;
            $setting->save();
          }
    }
}
