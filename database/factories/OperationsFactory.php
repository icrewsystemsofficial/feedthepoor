<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donations;
use App\Models\Location;
use App\Models\Causes;
use App\Models\Campaigns;
use App\Models\User;

class OperationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'donation_id' => Donations::all()->random()->id,
            'location_id' => Location::all()->random()->id,
            'procurement_item' => Causes::all()->random()->name,
            'procurement_quantity' => $this->faker->numberBetween(1, 10),
            'vendor' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['UNACKNOWLEDGED', 'ACKNOWLEDGED', 'PROCUREMENT ORDER INITIATED','DELAYED','READY FOR MISSION DISPATCH','ASSIGNED TO MISSION','FULFILLED']),
            'last_updated_by' => User::all()->random()->id,
            'mission_id' => $this->faker->numberBetween(1, 10),        
        ];
    }
}
