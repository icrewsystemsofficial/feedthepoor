<?php
 namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\SettingGroup;
use Illuminate\Support\Facades\DB;

class SettingsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings_group')->truncate();

        $settings = new SettingGroup;
        $settings->name = 'Application Settings';
        $settings->description = 'The basic settings of Feed The Poor';
        $settings->save();






    }
}
