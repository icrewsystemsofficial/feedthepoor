<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaigns;
use App\Models\Location;
use App\Models\Causes;
use Illuminate\Support\Str;

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
        $cause_bool = 1; //rand(0, 1) A campaign must have a cause right ?
        $is_goal = rand(0, 1);

        $campaign_names = array(
            'Feeding poor children',
            'Cyclone Amphan: Relief program',
            'Help Assam: Relief Program',
            'Feed stray dogs',
        );

        $name = $campaign_names[array_rand($campaign_names)];


        return [
            'campaign_name' => $name,
            'campaign_description' => $this->faker->text,
            'campaign_poster' => $this->faker->imageUrl(),
            'is_campaign_goal_based' => $is_goal,
            'campaign_goal_amount' => $this->faker->numberBetween(50000, 100000),
            'campaign_start_date' => $this->faker->date,
            'campaign_end_date' => ($is_goal) ? $this->faker->date : null,
            'campaign_location' => json_encode($locations),
            'campaign_has_cause' => $cause_bool,
            'campaign_causes' => ($cause_bool) ? json_encode($causes) : json_encode([]),
            'campaign_status' => $this->faker->numberBetween(0, 1),
            'slug' => Str::slug($name),
        ];
    }
}
