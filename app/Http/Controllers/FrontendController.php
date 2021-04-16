<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Faker;
class FrontendController extends Controller
{
    public function index(){

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

    public function whoDidWeFeedToday(){
        return view('frontend.whoDidWeFeedToday');
    }

    public function about(){
        return view('frontend.about');
    }

    public function howDoesItWork(){
        return view('frontend.howDoesItWork');
    }

    public function volunteers(){
        return view('frontend.volunteers');
    }

    public function partners(){
        return view('frontend.partners');
    }

    public function testimonials(){
        return view('frontend.testimonials');
    }

    public function gallery(){
        return view('frontend.gallery');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function error(){
        return view('frontend.error');
    }
}
