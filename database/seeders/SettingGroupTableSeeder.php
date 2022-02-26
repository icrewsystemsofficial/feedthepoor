<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingGroupTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('setting_group')->delete();
        
        \DB::table('setting_group')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Application Override',
                'description' => 'These settings override the application defaults',
                'created_at' => '2022-02-26 16:42:33',
                'updated_at' => '2022-02-26 16:42:33',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Operational Settings',
                'description' => 'Operational settings required for day to day NGO operations',
                'created_at' => '2022-02-26 17:14:54',
                'updated_at' => '2022-02-26 17:14:54',
            ),
        ));
        
        
    }
}