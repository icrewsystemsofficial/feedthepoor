<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Causes;
use App\Models\Donations;
use App\Models\Operations;
use App\Models\Campaigns;
use App\Models\Location;
use Illuminate\Database\Seeder;


class OperationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Operations::factory()->count(10)->create();

        # Getting
        $donations = Donations::where('donation_status', Donations::$status['PENDING'])->get();
        foreach($donations as $donation) {

            $operation = new Operations;
            $cause = $donation->cause_id ? Causes::where('id', $donation->cause_id)->first():0;
            $campaign = $donation->campaign_id ? Campaigns::where('id', $donation->campaign_id)->first():0;
            $location = Location::all()->random()->id;

            $procurement_quantity = $cause ? round($donation->donation_amount / $cause->per_unit_cost):0;


            # Procurement Item.
            $operation->location_id = $location;
            $operation->donation_id = $donation->id;
            $operation->procurement_item = $cause ? $cause->name:$campaign->campaign_name;
            $operation->procurement_quantity = ($procurement_quantity == 0) ? 0 : $procurement_quantity;
            $operation->vendor = 'Local Vendor';
            $operation->status = rand(0, 6);
            $operation->last_updated_by = User::inRandomOrder()->first()->id;
            $operation->mission_id = null;

            $operation->save();

            # Adding Activity log
            activity()
            ->performedOn($operation)
            ->log('Operations: Procurement added for donation #'. $donation->id.'');
        }


    }
}
