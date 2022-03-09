<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location_name' => array('Ajmer','Delhi','Lucknow','Bangalore')[rand(0,3)],
            'location_description' => $this->faker->text(50),
            'location_address' => $this->faker->text(100),
            'location_pin_code' => rand(100000,999999),
            'location_latitude' => $this->faker->latitude(),
            'location_longitude' => $this->faker->longitude(),
            'location_manager_id' => User::all()->random()->id,
            'location_status' => rand(0,3),            
        ];
    }
}
