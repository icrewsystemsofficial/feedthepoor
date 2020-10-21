<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Donation;
use App\Volunteer;
use App\Partner;
use App\Testimonial;
use Illuminate\Support\Facades\Mail;




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

      return view('home.volunteers');

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

    public function contacts(Request $request) {
      // contacts
      //  $contact = new contact;
      // $contacts->first_name = $request->input('first_name');
      // $contacts->contact = $request->input('contact');
      // $contacts->email = $request->input('email');
      // $contacts->subject = $request->input('subject');
      // $contacts->comments = $request->input('comments');


      // $partner->save();
      // \Mail::to($request->input('email'))->send(new Contact($request->input()));

      return view('home.contacts');

    }

    public function contactsuccess() {
      //Bharath
        notify()->success('Thank you for Contacting Us', 'Yay!');
      return view('home.volunteerssuccess');
    }

    public function testimonialsuccess(Request $request) {
      // Apoorv: Handle when a testimonial is submitted from the frontend form.
      $validatedData = $request->validate([
        'full_name' => 'required|max:255',
        'email' => 'required',
      ]);
      return view('home.comingsoon');
      //return dd($request);
      //$testimonial = new Testimonial;
    }


    public function mission() {
      return view('home.mission');
    }

}
