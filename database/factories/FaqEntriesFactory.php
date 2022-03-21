<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqEntriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 3),
            'entry_question' => $this->faker->text,
            'entry_answer' => $this->faker->text,
            'author_name' => User::all()->random()->name,
        ];
    }
}
