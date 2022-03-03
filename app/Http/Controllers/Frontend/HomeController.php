<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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
            $faker = Faker\Factory::create('en_IN');
            for($i = 0; $i < $howmany; $i++) {
                $names[$i] = $faker->firstName;
            }

            return json_encode($names);
        }


        $donation_random_images = generateRandomImages(50);
        $donation_names = generateRandomDonorNames(50);

        return view('frontend.index', [
            'donation_images' => $donation_random_images,
            'donation_names' => $donation_names,
            'total_meals_fed' => $total_meals_fed,
            'total_donations_received' => $total_donations_received
        ]);
    }
}
