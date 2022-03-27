<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Causes;

class CausesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Causes::factory()->times(2)->create();
    }
}
