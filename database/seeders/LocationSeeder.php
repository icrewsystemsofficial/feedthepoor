<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\User;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first()->id;

        $locations = [
            [
                'location_name' => 'Koramangala, Bangalore',
                'location_address' => '8th Block, 80 Feet Rd, Koramangala, Bengaluru, Karnataka',
                'location_pin_code' => '560095',
                'location_latitude' => '12.9459162',
                'location_longitude' => '77.6169457',
                'location_manager_id' => $user,
                'location_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Murlipura, Jaipur',
                'location_address' => 'Dadi Ka Phatak, Murlipura, Jaipur, Rajasthan',
                'location_pin_code' => '302032',
                'location_latitude' => '26.9687614',
                'location_longitude' => '75.7536621',
                'location_manager_id' => $user,
                'location_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_name' => 'Nosar, Ajmer',
                'location_address' => '2KH/16, Gulmohar Colony, Nosar, Ajmer, Rajasthan',
                'location_pin_code' => '305004',
                'location_latitude' => '26.487556',
                'location_longitude' => '74.625583',
                'location_manager_id' => $user,
                'location_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
