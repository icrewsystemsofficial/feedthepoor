<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.welcome');
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
}
