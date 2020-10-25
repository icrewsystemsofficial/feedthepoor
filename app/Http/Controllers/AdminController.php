<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Razorpay\Api\Api;
use App\Mail\Admin\SendMail;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Donation;
use App\Testimonial;
use App\User;

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
    $payments = Donation::all();
    return view('admin.payments.payments')->with('payments', $payments);
  }

  public function donation_details($id = '') {
    if($id == '') {
      notify()->error('ID cannot be invalid', 'Whoops');
      return redirect(url('/admin'));
    }

    $payment = Donation::where('id', $id)->first();
    return view('admin.payments.details')->with('payment', $payment);
  }


  public function razorpay() {
    //Use $payments = Donation::all()
    $api = new Api("rzp_test_tufnOqSwzLJerx", "XS0PnaNKJP9GhuaHtzfrtygg");
    $params = array(
      'count' => 50,
      'skip'  => 1
    );
    $payments = $api->payment->all($params);
    return view('admin.payments.razorpay')->with('payments', $payments->items);
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

  public function data() {
    // display DB data, by Saurabh
      $donations = Donation::all();
      return view('admin.payments.data')->with('donations', $donations);
  }

  public function testimonials() {
    // Display list of all testimonials, by Apoorv
    $testimonials = Testimonial::orderBy('status','DESC')->orderBy('created_at','DESC')->get();
    return view('admin.testimonials.list', ['testimonials'=>$testimonials]);
  }

  public function testimonialstatus(Request $request) {
    // Update status of testimonial (API), by Apoorv
    $validatedData = $request->validate([
      'id' => 'required',
      'status' => 'required',
      'user' => 'required',
    ]);
    //$user_id = Crypt::decryptString($request->user);
    $user = User::find($request->user);
    $testimonial = Testimonial::find($request->id);
    if(!$user)
    {
      $response['status'] = '404';
      $response['message'] = 'No user was found with the ID. If you think this is a mistake, please contact us.';
    }
    elseif(!$testimonial)
    {
      $response['status'] = '404';
      $response['message'] = 'No testimonial was found with the ID '.$request->id.'. If you think this is a mistake, please contact us.';
    }
    elseif($request->status!=0 && $request->status!=1 && $request->status!=2)
    {
      $response['status'] = '500';
      $response['message'] = 'The status '.$request->status.' is not within the accepted range. If you think this is a mistake, please contact us.';
    }
    else
    {
      $testimonial->status = $request->status;
      $testimonial->save();
      $response['status'] = '200';
      $response['message'] = 'The testimonial status has been updated to '.array('Unapproved','Approved','Featured')[$testimonial->status].'. Refreshing the page now!';
    }
    return response($response);
  }

  public function approvetestimonials(Request $request)
  {
    $validatedData = $request->validate([
      'user' => 'required',
    ]);
    //$user_id = Crypt::decryptString($request->user);
    $user = User::find($request->user);
    if(!$user)
    {
      $response['status'] = '404';
      $response['message'] = 'No user was found with the ID. If you think this is a mistake, please contact us.';
    }
    else
    {
      $count = Testimonial::where('status',0)->count();
      $testimonials = Testimonial::where('status',0)->update(['status'=>1]);
      $response['status'] = '200';
      $response['message'] = $count.' testimonial(s) have been approved. Refreshing the page now!';
    }
    return response($response);
  }
}
