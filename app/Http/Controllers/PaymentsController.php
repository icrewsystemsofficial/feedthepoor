<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Invoice;
use DB;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
use App\Donation;

class PaymentsController extends Controller
{
    public function money($money = '300') {
      return view('payments.money')->with('amount', $money);
    }

    public function process(Request $request) {
      return view('payments.process')->with('post', (object) $request->input());
    }

    public function verify(Request $request) {
      $api = new Api("rzp_test_tufnOqSwzLJerx", "XS0PnaNKJP9GhuaHtzfrtygg");
      // $params = array(
      //   'count' => 5,
      //   'skip'  => 1
      // );
      // $payments = $api->payment->all($params);
      $payment = $api->payment->fetch($request->input('razorpay_payment_id'));

          //storing user data to DB
            if($payment){
            $donation = new Donation;
            $donation->payments_id = $request->input('payments_id');
            $donation->donor_name = $request->input('donor_name');
            $donation->date = $request->input('date');
            $donation->save();
          }
          else{
            notify()->error('error', 'There was an error');
            return redirect('/index');
          }

      return view('payments.success')->with('payment', $payment);
    }


    public function index($id) {
      $invoice = Invoice::find($id);
      if($invoice == '') {
        // If invoice not found, show error page.
        // CHANGE to a notification later on.
        return redirect(url('error'));
      } else {
        // Client Data
        $client = DB::table('clients')->select('*')->where('id', $invoice->client_id)->first();
        // Project Data
        $project = DB::table('projects')->select('*')->where('id', $invoice->project_id)->first();
        //User Data
        $user = DB::table('users')->select('*')->where('client_id', $client->id)->first();
        // Bill Data
        $bill = DB::table('invoice_items')->select('*')->where('invoice_id', $invoice->id)->get();

        //Getting Total Invoice Amount. and Mult by 100 cuz Akaunting/Money requires it that way.
        $invoice_prefix = DB::table('settings')->select('*')->where('setting_name', 'invoice_prefix')->first();
        $invoice_amount = DB::table('invoice_items')->where('invoice_id', $invoice->id)->sum('total');
        // $invoice_amount = $invoice_amount * 100;

        $currency = $client->currency_symbol;
        if($currency == '') {
          $currency = 'USD';
        } else if($currency == '$') {

        } else  {
          $currency_symbol = $client->currency_symbol;
          $currency = 'USD';
        }

        notify()->success('Invoice with '.$invoice_prefix->setting_value.''.$id.' loaded.', 'PAYMENTS APP');
        return view('payments.index')
        ->with('currency', $currency)
        ->with('invoice_prefix', $invoice_prefix)
        ->with('invoice_amount', $invoice_amount)
        ->with('user', $user)
        ->with('bill', $bill)
        ->with('client', $client)
        ->with('project', $project)
        ->with('invoice', $invoice);
      }
    }


    public function request() {
      return view('payments.request');
    }

    public function response() {
      notify()->success('Yay! This is a custom message ⚡️', 'Response Received');
      return view('payments.response');
    }

    public function convert($base, $to, $amount) {
      $api = Http::get('https://api.exchangeratesapi.io/latest?base='.$base);
      $base_value = $api['rates'][$to];
      $converted_value = $base_value * $amount;
      $converted_value = number_format((float)$converted_value, 2, '.', '');
      $response = array();
      $response['converted_amount'] = $converted_value;
      $response['converted_currency'] = $to;
      $response['base_currency'] = $base;
      $response['conversion_rate'] = $base_value;
      return response($response, 200)->header('Content-Type', 'application/json');
    }
}
