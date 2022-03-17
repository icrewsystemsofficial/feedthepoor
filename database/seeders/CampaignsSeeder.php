<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaigns;

class CampaignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaigns::factory()->times(5)->create();
    }
}
