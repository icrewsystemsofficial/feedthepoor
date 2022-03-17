<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donations;


class DonationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donations::factory(10)->create();
    }
}
