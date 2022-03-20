<?php

namespace Database\Factories;


use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CausesFactory extends Factory
{
    /**
     * Define the model"s default state.
     *
     * @return array
     */
    public function definition()
    {

        $random = array("Wheelchair","Stationary","Sweater", "Prosthetic leg","Shoes", "Dry Ration","Prosthetic arm", "Food")[rand(0,2)];

        return [
            "name" => Str::ucfirst($random),
            "icon" => $random,
            "per_unit_cost" => rand(2,100),
            "yield_context" => "This donation will help %YIELD% people",
        ];
    }
}
