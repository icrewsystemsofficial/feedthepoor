<?php

namespace App\Http\Controllers\Frontend;

use Faker\Factory;
use App\Models\Causes;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\RazorpayAPIController;

class HomeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() {
                //Stats that are passed into the frontend page.
        // This will have to be made dyanmic.

        $total_meals_fed = 850;
        $total_donations_received = 42500;
        $howmany = 50;

        $images = array();
        $height = 300;
        for($i = 0; $i < $howmany; $i++) {
            $url = "https://picsum.photos/800/". $height ."";
            $images[$i] = $url;
            $height++;
        }


        $names = array();
        $faker = Factory::create('en_IN');
        for($i = 0; $i < $howmany; $i++) {
            $names[$i] = $faker->firstName;
        }

        $donation_random_images = json_encode($images);
        $donation_names = json_encode($names);

        return view('frontend.index', [
            'donation_images' => $donation_random_images,
            'donation_names' => $donation_names,
            'total_meals_fed' => $total_meals_fed,
            'total_donations_received' => $total_donations_received
        ]);
    }

    public function about () {

        $locations = Location::where('location_status', 1)->get();

        return view('frontend.about.index', [
            'locations' => $locations,
        ]);
    }

    public function volunteer () {
        return view('frontend.volunteer.index');
    }
    /**
     * donate - the page where users can donate money.
     *
     * @return void
     */
    public function donate() {
        $causes = Causes::all();


        // Argh, this is an uneccesary move ig. Will be fixed when sending data from controller.

        $donation_types = array();
        foreach($causes as $cause) {
            $donation_types[$cause->name] = $cause;
        }

        return view('frontend.donation.index', [
            'donation_types' => $donation_types,
        ]);
    }

    /**
     * donate_process - The payment gateway page
     *
     * @param  mixed $razorpay_order_id
     * @return void
     */
    public function donate_process($razorpay_order_id = null) {
        if($razorpay_order_id == null) {
            return redirect()->route('frontend.donate');
        }

        $order = app(RazorpayAPIController::class)->fetch_order($razorpay_order_id);
        //TODO Handle failure


        return view('frontend.donation.payment', [
            'order' => $order,
        ]);
    }

    /**
     * thank_you - A payment ID is required to enter this page
     *
     * @param  mixed $payment_id
     * @return void
     */
    public function thank_you($payment_id = null) {
        return view('frontend.donation.thank_you', [
            'payment_id' => $payment_id,
            'payment' => app(RazorpayAPIController::class)->fetch_payment($payment_id),
        ]);
    }


    // function created by sathish
    public function track_donation($donation_id = ''){


        $faker = Factory::create('en_IN');
        $donation_name = $faker->firstName();

        // dd($names_json);
        return view('frontend.tracking.tracking', [
            'donation_name' => $donation_name,
        ]);
    }

}
