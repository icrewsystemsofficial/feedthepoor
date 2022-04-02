<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Razorpay\Api\Api as RazorpayAPI;
use App\Events\Donations\DonationReceived;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RazorpayAPIController extends Controller
{


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->key_id = 'rzp_test_SmU75lqcibiulc'; #Should be loaded from settings module.
        $this->secret = 'BSe2Who1QIS4heUJBapZImfr'; #Should be loaded from settings module.
    }

    /**
     * create_order
     *
     * @param  mixed $request
     * @return void
     */
    public function create_order(Request $request) {


        $receipt_id = now()->format('d-m-Y').'-'.rand(10000,99999); // Will be Auto increment ID as per DB.

        $amount = ($request->input('amount') * 100); // Razorpay requires amount in paise.

        $razorpay_notes = collect(request()->input());
        $razorpay_notes->forget('_token'); // No need to pass CSRF token to razorpay lol.
        $razorpay_notes->toArray();


        $api = new RazorpayAPI($this->key_id, $this->secret);
        $order = $api->order->create(
            array(
                'receipt' => $receipt_id,
                'amount' => $amount,
                'currency' => 'INR',
                'notes'=> $razorpay_notes->toArray(),
                'payment' => array(
                    'capture' => 'automatic',
                    'capture_options' => array(
                        'automatic_expiry_period' => 12,
                        'manual_expiry_period' => 7200,
                        'refund_speed' => 'optimum'
                    )
                ),
            )
        );

        // TODO This order details should be saved on DB

        return redirect()->route('frontend.donate.process', $order->id);

    }

    /**
     * fetch_order
     *
     * @param  mixed $order_id
     * @return void
     */
    public function fetch_order($order_id) {
        $api = new RazorpayAPI($this->key_id, $this->secret);
        $order = $api->order->fetch($order_id);
        return $order;
    }

    /**
     * fetch_payment
     *
     * @param  mixed $payment_id
     * @return void
     */
    public function fetch_payment($payment_id) {
        $api = new RazorpayAPI($this->key_id, $this->secret);
        $payment = $api->payment->fetch($payment_id);
        return $payment;
    }

    public function payment_received($payment_id) {

        # Check if the payment is received
        $api = new RazorpayAPI($this->key_id, $this->secret);
        $payment = $api->payment->fetch($payment_id);
        // dd($payment);
            # Trigger the event
        event(new DonationReceived($payment));


        # Redirect to the thank-you page.
        return redirect()->route("frontend.donate.thank_you", $payment_id);


        // try {

        // } catch (Exception $e) {

        //     # The app is unable to fetch the Razorpay payment details using the given
        //     # payment_ID

        //     throw new Exception('Razorpay API Error: '.$e->getMessage());
        //     # hopefully, this throws an error to Larabug.

        //     # Fire's a Payment Failed e-mail
        //     // TODO PAyment failed e-mail

        // }
    }
}
