<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
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
}
