<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaigns;
use App\Models\Location;
use App\Models\Causes;

class CampaignsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $location_names = [];
        $locations = Location::inRandomOrder()->limit(5)->get();
        foreach ($locations as $location) {
            $location_names[] = $location->location_name;
        }
        $causes = Causes::inRandomOrder()->limit(5)->get();
        $cause_names = [];
        foreach ($causes as $cause) {
            $cause_names[] = $cause->name;
        }
        $cause_bool = rand(0, 1);
        $is_goal = rand(0, 1);
        return [
            'campaign_name' => $this->faker->name,
            'campaign_description' => $this->faker->text,
            'campaign_poster' => $this->faker->imageUrl(),
            'is_campaign_goal_based' => $is_goal,
            'campaign_goal_amount' => $this->faker->numberBetween(1, 100),
            'campaign_start_date' => $this->faker->date,
            'campaign_end_date' => ($is_goal) ? $this->faker->date : null,
            'campaign_location' => json_encode($location_names),
            'campaign_has_cause' => $cause_bool,
            'campaign_causes' => ($cause_bool) ? json_encode($cause_names) : json_encode([]),
            'campaign_status' => $this->faker->numberBetween(0, 1),            
        ];
    }
}
