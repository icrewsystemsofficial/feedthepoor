<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
use App\Mail\Admin\SendMail;
use Illuminate\Support\Facades\Mail;

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
}
