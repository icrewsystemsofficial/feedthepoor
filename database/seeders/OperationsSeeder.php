<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Causes;
use App\Models\Donations;
use App\Models\Operations;
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
            $cause = Causes::where('id', $donation->cause_id)->first();

            $procurement_quantity = round($donation->donation_amount / $cause->per_unit_cost);


            # Procurement Item.

            $operation->donation_id = $donation->id;
            $operation->procurement_item = $cause->name;
            $operation->procurement_quantity = ($procurement_quantity == 0) ? 1 : $procurement_quantity;
            $operation->vendor = 'Local Vendor';
            // $operation->status = array('UNACKNOWLEDGED', 'READY FOR MISSION DISPATCH')[1];
            $operation->status = 'READY FOR MISSION DISPATCH';
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
