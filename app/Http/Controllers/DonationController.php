<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;

class DonationController extends Controller
{
    public function index(){
        $data = Donation::all();
        return view ('user_donation' )->with(compact('data', $data ));
    }
}
