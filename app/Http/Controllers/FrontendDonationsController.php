<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendDonationsController extends Controller
{
    public function index() {
        return view('frontend.donate.index');
    }

    public function process($howmuch = 50) {
        return "Donation amount = $howmuch";
    }
}
