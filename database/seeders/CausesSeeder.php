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
          /*

            Birthday celebration and food causes can be grouped together and 
            the days/kids can be stored as nested arrays along with their respective amounts (json_encode).

            This would mean that a refactor has to be done in many parts of the app to make it work.
            So as of now I have them as separate causes and I am not sure if this is the best way to do it.

            March 26, 2022
            Anirudh R

        */

        $causes = array (
            [
                'name' => 'Shoes',
                'icon' => 'shoe-prints',
                'per_unit_cost' => 300,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Stationary kits',
                'icon' => 'pencil-ruler',
                'per_unit_cost' => 600,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Tricycle',
                'icon' => 'bicycle',
                'per_unit_cost' => 12500,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Feed children for 10 days',
                'icon' => 'pizza-slice',
                'per_unit_cost' => 490,
                'yield_context' => 'This donation will help %YIELD% people',                
            ],
            [
                'name' => 'Feed children for 20 days',
                'icon' => 'pizza-slice',
                'per_unit_cost' => 980,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Feed children for 30 days',
                'icon' => 'pizza-slice',
                'per_unit_cost' => 1470,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Prosthetic leg',
                'icon' => 'walking',
                'per_unit_cost' => 8999,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Birthday celebration with 22 children',
                'icon' => 'birthday-cake',
                'per_unit_cost' => 1999,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Birthday celebration with 44 children',
                'icon' => 'birthday-cake',
                'per_unit_cost' => 2999,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Birthday celebration with 66 children',
                'icon' => 'birthday-cake',
                'per_unit_cost' => 3999,
                'yield_context' => 'This donation will help %YIELD% people',
            ],
            [
                'name' => 'Birthday celebration with 100 children',
                'icon' => 'birthday-cake',
                'per_unit_cost' => 4999,
                'yield_context' => 'This donation will help %YIELD% people',
            ]
        );

        foreach ($causes as $cause) {
            Causes::create($cause);
        }
    }
}
