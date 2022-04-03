<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operations;

class OperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operations::factory()->count(10)->create();
    }
}
