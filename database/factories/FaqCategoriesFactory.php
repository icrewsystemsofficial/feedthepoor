<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => array('Donation', 'Payments', 'General')[rand(0,2)],
            'category_description' => $this->faker->text,
            'category_status' => rand(0, 1),
        ];
    }
}
