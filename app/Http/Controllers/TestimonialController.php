<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.testimonial');
    }
    public function addData(Request $req){
        $user->name=Auth::user()->name;
        $user->testimonial=$req->testimonial;
        $user->save();
    }
}
