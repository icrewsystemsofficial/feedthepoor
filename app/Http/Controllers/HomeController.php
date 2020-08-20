<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Donation;
use App\Volunteer;
use App\Partner;


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

    public function aboutus() {
      return view('home.aboutus');
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

    public function work() {
      // Testimonials
      return view('home.work');
    }

    public function volunteers(Request $request) {
      // Volunteers
      /*$volunteer = new Volunteer;
      $volunteer->first_name = $request->input('first_name');
      $volunteer->last_name = $request->input('last_name');
      $volunteer->dob = $request->input('DOB');
      $volunteer->state = $request->input('state');
      $volunteer->city = $request->input('city');
      $volunteer->zip = $request->input('zip');
      $volunteer->current_institution = $request->input('current_institution');
      $volunteer->contact_number = $request->input('contact');
      $volunteer->email = $request->input('email');
      $volunteer->comments = $request->input('comments');


      $volunteer->save();*/

      return view('home.volunters');

    }

    public function partners(Request $request) {
      // Partners
      /*$partner = new Partner;
      $partners->organisation_name = $request->input('organisation_name');
      $partners->organisation_address = $request->input('organisation_address');
      $partners->state = $request->input('state');
      $partners->city = $request->input('city');
      $partners->zip = $request->input('zip');
      $partners->contact = $request->input('contact');
      $partners->email = $request->input('email');
      $partners->comments = $request->input('comments');


      $partner->save();*/

      return view('home.partners');

    }

    public function partnerssuccess() {
      //Bharath
        notify()->success('You are Successfully registered as a Partner', 'Yay!');
      return view('home.partnerssuccess');
    }



    public function volunteerssuccess() {
      //Bharath
        notify()->success('You are Successfully registered as a Volunteer', 'Yay!');
      return view('home.volunteerssuccess');
    }



    public function contact() {
      // Testimonials
      return view('home.contact');
    }

    public function add() {
      // adding a manual donation, by Saurabh
        return view('admin.donations.add');
    }
}
