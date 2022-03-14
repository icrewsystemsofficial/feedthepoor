<?php

namespace Database\Factories;

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
        return [
            "name" => $this->faker->text(10),
            "icon" => array("wheelchair","box","tshirt")[rand(0,2)],
            "per_unit_cost" => rand(2,100),
            "yield_context" => "ahdfkdaskfkjdsakf %YIELD% kasjfasndjfkadnk aksdnfjansdkf asdjfnkjsafjksf",
        ];
    }
}
