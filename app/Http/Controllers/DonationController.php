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
    public function donation_customer(){
       // $data = Donation::all();
        return view ('donation.index' );
    }
    public function donation_customer1(){
        // $data = Donation::all();
         return view ('donation.index1' );
     }
     public function save(Request $request)
    {
       /* $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255,' ,
            'current_password' => 'nullable|required_with:new_password',
            'address' => 'nullable|required',
            'phone' => 'nullable|required',
            'gender' => 'nullable|required',
            'city' => 'nullable|required',

            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);*/


        $user =new Donation;
        $user->razorpay_id="1";
        $user->donor_firstname = $request->input('name');
        $user->donor_lastname = $request->input('last_name');
        $user->donor_email = $request->input('email');
        $user->dob = $request->input('dob');

        $user->donor_address = $request->input('address');
        $user->landmark = $request->input('landmark');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');
        $user->donation_amount = $request->input('amount');
        $user->comments = $request->input('comments');
        $user->invoice_id = "1";
        
        $user->pan_id = $request->input('panid');

        $user->status = "1";

        
        $user->save();
        
        activity()
        ->causedBy($user)
        ->log('donaton made by '.$user->name.'');

        return redirect()->route('home')->withSuccess('donation successfully.');
    }
}
