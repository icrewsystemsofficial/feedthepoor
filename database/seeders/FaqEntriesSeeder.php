<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqEntries;

class FaqEntriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqEntries::factory()->times(5)->create();
    }
}
