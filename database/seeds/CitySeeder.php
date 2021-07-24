<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\City;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Seeding Cities from JSON file');
        $json = File::get('database/json/cities.json');
        $data = json_decode($json);
        foreach($data as $obj) {
            foreach($obj as $city) {


                //$city_find = City::where('name', $city->name)->first();
               // if(!$city_find) {
                    $db_city = new City;
                    $db_city->name = $city->name;
                    $db_city->state = $city->State;
                    $db_city->created_at = now()->toDateTimeString();
                    $db_city->updated_at = now()->toDateTimeString();
                    $db_city->save();
                    $this->command->info($city->name.'was added');
               // } else {
                //    $this->command->error($city->name.' already exists');
                //}
            }
        }
    }
}
