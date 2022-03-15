<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategories;

class FaqCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqCategories::factory()->times(3)->create();
    }
}
