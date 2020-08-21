<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use App\User;
use App\Invoice;
use App\Donation;
use App\Mail\Confirm;
use Razorpay\Api\Api;
use Akaunting\Money\Money;
use Illuminate\Http\Request;
use Akaunting\Money\Currency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class PaymentsController extends Controller
{
    public function money($money = '300')
    {
        return view('payments.money')->with('amount', $money);
    }

    public function process(Request $request)
    {
        return view('payments.process')->with('post', (object) $request->input());
    }

    public function downloadRecipt($id) {
      //For some reason, we are unable to attach pdf to email. so we made a method to just download it from server.
      $file= storage_path('recipts/recipt_'.$id.'.pdf');
      $headers = array('Content-Type: application/pdf');
      Response::download($file, 'Donation_Recipt.pdf', $headers);
      return redirect(url(''));
    }


    public function verify(Request $request)
    {
        $api = new Api("rzp_test_tufnOqSwzLJerx", "XS0PnaNKJP9GhuaHtzfrtygg");
        $payment = $api->payment->fetch($request->input('razorpay_payment_id'));
        //storing user data to DB
        if ($payment) {
        	//This means there's a Payment in RazorPay's API with the given ID, now, we gotta verify if there's a record
        	// already existing in our DB with that Payment ID, if yes, we don't have to save it again, if not, then we save it. -Leonard.


          $check = Donation::where('payment_id', $request->input('razorpay_payment_id'));
          if($check == true) {
          	// The payment already exists on the DB, which means this code was already executed once and the user
          	// is just trying to reload the page again. So to save our servers, we prevent processing and just display the already existing
          	// values.


          } else {
          	// code is running for the first time, so we let it run.

          	// SAVING TO DB

          	$donation = new Donation;
			      $donation->payments_id = $payment->id;
            // if(count($donation->payments_id->value())>1){
            // }else{
            //   $donation->payments_id = $payment->id;
            // }

            // Saurabh, this doesn't work. Gave me an error.
            // What were you trying to accomplish tho?
            // From what I see, you're trying to verify a condition if
            // the value of the payment ID is > than 1. Defnitely it will be, because
            //this part of the code is ONLY executed if the method is able to verify payments from the API.
            // So, No need of it. On the other hand, Instagram is optional, so you gotta add a conditional statement to it.

            //- Leonard, 19/08/2020.
            $donation->donor_name = $payment->notes->name;
            $donation->donor_email = $payment->email;
            $donation->donor_instagram = $payment->notes->instagram;
            $donation->save();

        	// PDF GENERATION

            //Samay, Generating a PDF and saving it on /recipts.
            // f9342a29eedc92907549fd5fadf13555b18ac6f2

            if(!File::exists(storage_path('recipts'))) {
              File::makeDirectory(storage_path('recipts'), 0755, true, true);
            }


            $array = [$payment];
            view()->share('payment', $array);
            $pdf = PDF::loadView('receipt.pdf_view', $array);
            $pdf->setPaper('A4', 'portrait');
            $pdfpath = storage_path("recipts". DIRECTORY_SEPARATOR ."recipt_".$payment->id.".pdf");
            $pdf->save($pdfpath);
            // QUEUE AN EMAIL TO ADMINS.
          }

            // SEND AN EMAIL TO USER, ATTACH THE RECIPT.              
              Mail::to($payment->email)->send(new Confirm($payment, $payment->id));
              notify()->success('Payment details were added to the database. We are generating and sending your report.', 'Yay!');

            // Use this if you want to test the PDF, -Leonard, 19/8/2020.
            // return view('receipt.pdf_view')->with('payment', (object) $payment);
        } else {
            notify()->error('We were not able to find a payment with the specified ID (' . $request->input('razorpay_payment_id') . '). If the amount was deducted from your account, please contact us. Further information will be mailed to you by RazorPay.', 'Whoopsie!');
            return redirect('/index');
        }

        return view('payments.success')->with('payment', $payment);
    }


    public function index($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice == '') {
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
            if ($currency == '') {
                $currency = 'USD';
            } else if ($currency == '$') {
            } else {
                $currency_symbol = $client->currency_symbol;
                $currency = 'USD';
            }

            notify()->success('Invoice with ' . $invoice_prefix->setting_value . '' . $id . ' loaded.', 'PAYMENTS APP');
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


    public function request()
    {
        return view('payments.request');
    }



    public function response()
    {
        notify()->success('Yay! This is a custom message ⚡️', 'Response Received');
        return view('payments.response');
    }

    public function convert($base, $to, $amount)
    {
        $api = Http::get('https://api.exchangeratesapi.io/latest?base=' . $base);
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
