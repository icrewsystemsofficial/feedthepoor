<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Donation;
use App\Volunteer;


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
      //{{ dd($request->input()) }}
      /*$volunteer = new Volunteer;
      $volunteer->first_name = $request->input('first_name');
      $volunteer->last_name = $request->input('last_name');
      $volunteer->DOB = $request->input('DOB');
      $volunteer->State = $request->input('state');
      $volunteer->City = $request->input('city');
      $volunteer->zip = $request->input('zip');
      $volunteer->Current_Institution = $request->input('current_institution');
      $volunteer->Contact_number = $request->input('contact');
      $volunteer->email = $request->input('email');
      $volunteer->save();*/

      return view('home.volunteers');

    }

    public function volunteerssuccess() {
      //Bharath
      return view('home.volunteerssuccess');
    }

    public function partners() {
      // Testimonials
      return view('home.partners');
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
