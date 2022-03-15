<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DeveloperAccessSeeder::class);
        $this->call(SettingGroupTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(RolesandPermissionsSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(FaqCategoriesSeeder::class);
        $this->call(FaqEntriesSeeder::class);
        $this->call(CausesSeeder::class);
    }
}
