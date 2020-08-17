<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Donation;

class HomeController extends Controller
{
    public function index() {
      //Create views in resources/home. - Leonard Selvaraja.
      return view('home.index');
    }

    public function comingsoon() {
      return view('home.comingsoon');
    }


    //SAURABH
    public function faq() {
      //FAQ to be done by Saurabh.
      return view('home.faq');
    }

    //THARUN.
    public function success() {
      // When Payment is successful.
      return view('home.success');
    }

    public function error() {
      // When Payment is not successful.
      return view('home.error');
    }

    //Bharath
    public function testimonials() {
      // Testimonials
      return view('home.testimonials');
    }

    public function add() {
      // adding a manual donation, by Saurabh
        return view('admin.donations.add');
    }

    public function manual(Request $request) {
      // saving to DB, created by Saurabh
      $donation = new Donation;
      $donation->donor_name = $request->input('name');
      $donation->donor_email =  $request->input('email');
      $donation->donor_instagram =  $request->input('instagram');
      $donation->save();
      notify()->success('Payment details were added to the database. We are generating and sending your report.', 'Yay!');

      return view('admin.donations.add');

    }
}
