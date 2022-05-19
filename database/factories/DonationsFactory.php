<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donations;
use App\Models\Causes;
use App\Models\User;
use App\Models\Campaigns;

class DonationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random()->id;
        $choice = rand(0,1);
        $cause = Causes::all()->random()->id;
        $campaign = Campaigns::all()->random()->id;
        $amt = rand(1000,10000);
        return [
            'donor_id' => $user,
            'donor_name' => User::find($user)->name,
            'donation_amount' => $amt,
            'donation_in_words' => Donations::Show_Amount_In_Words($amt),
            'cause_id' => $choice ? $cause:null,
            'cause_name' => $choice ? Causes::find($cause)->name:null,
            'donation_status' => 0,
            'payment_method' => 4,
            'razorpay_payment_id' => 'pay_J3tG8jclByNtmN',
            'campaign_id' => $choice ? null:$campaign,
        ];
    }
}
