<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

  public function about() {
      // Testimonials
      return view('home.about');
    }

    public function work() {
      // Testimonials
      return view('home.work');
    }

    public function volunteers() {
      // Testimonials
      return view('home.volunteers');
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
