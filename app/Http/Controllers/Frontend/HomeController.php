<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\API\RazorpayAPIController;
use Faker\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        function generateRandomImages($howmany) {

            // This function gets images from a picture generator.
            // Once "picture-upload" feature is ready for this project,
            // we should update this function.
            // - Leonard, 16 April 2021.

            $images = array();
            $height = 300;
            for($i = 0; $i < $howmany; $i++) {
                $url = "https://picsum.photos/800/". $height ."";
                $images[$i] = $url;
                $height++;
            }

            return json_encode($images);
        }

        function generateRandomDonorNames($howmany) {

            // This function gets random donor names from FakerPHP
            // Once "donation" feature is ready for this project,
            // we should update this function.
            // - Leonard, 16 April 2021.

            $names = array();
            $faker = Factory::create('en_IN');
            for($i = 0; $i < $howmany; $i++) {
                $names[$i] = $faker->firstName;
            }

            return json_encode($names);
        }


        $donation_random_images = generateRandomImages(50);
        $donation_names = generateRandomDonorNames(50);

        $images_json = json_decode($donation_random_images, true);
        $names_json = json_decode($donation_names, true);  


        return view('frontend.tracking.tracking', [
            'donation_images' => $donation_random_images,
            'donation_names' => $donation_names,
            'track_names' => $names_json,
            'track_images' => $images_json,
            'total_meals_fed' => $total_meals_fed,
            'total_donations_received' => $total_donations_received
        ]);
    }

    /**
     * donate - the page where users can donate money.
     *
     * @return void
     */
    public function donate() {
        return view('frontend.donation.index');
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



}
