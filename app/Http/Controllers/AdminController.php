<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
use App\Mail\Admin\SendMail;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Donation;

class AdminController extends Controller
{
    public function index() {
      // notify()->success('hello', 'world');
      return view('admin.index');
    }

    public function logout() {
      return redirect('login')->with(Auth::logout());
    }

    public function donation() {
      //Use $payments = Donation::all()
      $api = new Api("rzp_test_tufnOqSwzLJerx", "XS0PnaNKJP9GhuaHtzfrtygg");
      $params = array(
        'count' => 50,
        'skip'  => 1
      );
      $payments = $api->payment->all($params);
      return view('admin.payments.payments')->with('payments', $payments->items);
    }

    public function mailer() {
      return view('admin.emails.index');
    }

    public function sendmail(Request $request) {
      //This method handles sending the email to a user.

      Mail::to($request->input('email'))->send(new SendMail($request->input()));
      notify()->success('Email was sent to '.$request->input('email').'', 'Yay!');

      return redirect(url('admin/mailer'));
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
