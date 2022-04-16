<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donations;
use App\Models\Causes;
use App\Models\User;

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
        $cause = Causes::all()->random()->id;
        $amt = rand(100,10000);
        // 'donation_status' => rand(0,3),
            // 'payment_method' => rand(0,4)
            // 'razorpay_payment_id' => rand(0,1) ? 'pay_J3tG8jclByNtmN' : null,
        return [
            'donor_id' => $user,
            'donor_name' => User::find($user)->name,
            'donation_amount' => $amt,
            'donation_in_words' => Donations::Show_Amount_In_Words($amt),
            'cause_id' => $cause,
            'cause_name' => Causes::find($cause)->name,
            'donation_status' => 0,
            'payment_method' => 4,
            'razorpay_payment_id' => 'pay_J3tG8jclByNtmN',
        ];
    }
}
