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
        $locations = [];
        $locations_list = Location::inRandomOrder()->limit(3)->get();
        foreach ($locations_list as $location) {
            if (!in_array($location->id, $locations)) {
                $locations[] = $location->id;
            }
        }
        $causes_list = Causes::inRandomOrder()->limit(3)->get();
        $causes = [];
        foreach ($causes_list as $cause) {
            if (!in_array($cause->id, $causes)) {
                $cause_names[] = $cause->id;
            }
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
            'campaign_location' => json_encode($locations),
            'campaign_has_cause' => $cause_bool,
            'campaign_causes' => ($cause_bool) ? json_encode($causes) : json_encode([]),
            'campaign_status' => $this->faker->numberBetween(0, 1),            
        ];
    }
}
