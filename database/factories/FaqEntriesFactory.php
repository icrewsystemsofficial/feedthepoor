<?php

namespace Database\Factories;

use App\Models\FaqCategories;
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
        $user = $this->faker->randomElement(User::all()->pluck('name')->toArray());
        $rand = rand(0, 3);
        $question = ['What is the belief behind #feedThePoor ?','Does #feedThePoor function in India or other countries too ?','How old is #feedThePoor ?','What is the outreach model ?'][$rand];
        $answer = ["We believe that unless members of the civil society are involved proactively in the process of development, sustainable change will not happen. Believing in this principle of 'Civic Driven Change'.","#feedThePoor is a national level development organization with its welfare projects spread across India.","#feedThePoor was established in the year 2002.","While working in the remote rural areas, #feedThePoor realized that capacities of community based organisations (CBOs) were not adequate to meet expectations of social investors. Under outreach model, #feedThePoor implements the development interventions directly as it requires intensive and professional engagement for a wider and sustained outcome."][$rand];

        $category_id = FaqCategories::inRandomOrder()->first()->id;
        return [
            'category_id' => $category_id,
            'entry_question' => $question,
            'entry_answer' => $answer,
            'author_name' => $user,
        ];
    }
}
