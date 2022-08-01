<?php

namespace App\Http\Controllers\Frontend;

use PDF;
use Faker\Factory;
use App\Models\User;
use App\Models\Causes;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Operations;
use App\Models\Campaigns;
use App\Models\Donations;
use App\Jobs\SendAdminJob;
use App\Models\FaqEntries;
use App\Models\userContact;
use Illuminate\Http\Request;
use App\Models\FaqCategories;
use Illuminate\Mail\Markdown;
use App\Jobs\SendConfirmationJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\API\RazorpayAPIController;

class HomeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //Stats that are passed into the frontend page.
        // This will have to be made dyanmic.

        $total_meals_fed = 0;
        foreach (Donations::all() as $donation) {
            $total_meals_fed += round($donation->donation_amount / Causes::find($donation->cause_id)->per_unit_cost);
        }

        $total_donations_received = Donations::all()->sum('donation_amount');
        $today_donations = Donations::all()->where('created_at', '<=', date('Y-m-d 00:00:00'))->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-30 day')))->sum('donation_amount');        
        $today_donors = Donations::all()->where('created_at', '<=', date('Y-m-d 00:00:00'))->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime('-30 day')))->count();

        // $images = array();
        // $height = 300;
        // for ($i = 0; $i < $howmany; $i++) {
        //     $url = "https://picsum.photos/800/" . $height . "";
        //     $images[$i] = $url;
        //     $height++;
        // }


        // $names = array();
        // $faker = Factory::create('en_IN');
        // for ($i = 0; $i < $howmany; $i++) {
        //     $names[$i] = $faker->firstName;
        // }

        // $donation_random_images = json_encode($images);
        // $donation_names = json_encode($names);

        // Not using Causes::all(); because of n+1 problem.
        $causes = Causes::where('name', '!=', null)->get();

        return view('frontend.index', [
            'total_meals_fed' => (int) $total_meals_fed,
            'total_donations_received' => $total_donations_received,
            'all_causes' => $causes,
            'today_donations' => $today_donations,
            'today_donors' => $today_donors,
        ]);
    }

    /**
     * about
     *
     * @return void
     */
    public function about()
    {
        $total_donations_received = Donations::all()->sum('donation_amount');
        $total_meals_fed = 0;
        foreach (Donations::all() as $donation) {
            $total_meals_fed += round($donation->donation_amount / Causes::find($donation->cause_id)->per_unit_cost);
        }
        $campaigns = Campaigns::all()->count();
        $locations = Location::where('location_status', 1)->get();
        return view('frontend.about.index', [
            'locations' => $locations,
            'campaigns' => $campaigns,
            'total_donations_received' => $total_donations_received,
            'total_meals_fed' => (int) $total_meals_fed,
        ]);
    }

    /**
     * partners - Page which lists all the partners of the organisation
     *
     * @return void
     */
    public function partners ()
    {
        return view('frontend.partners.index');
    }

    public function volunteer()
    {
        return view('frontend.volunteer.index');
    }
    
    /**
     * policies - Page which lists all the policies of the organisation
     *
     * @return void
     */
    public function policies(){
        return view('frontend.policies.index');
    }

    /**
     * donate - the page where users can donate money.
     *
     * @return void
     */
    public function donate()
    {
        $causes = Causes::where('name', '!=', null)->get();
        // Argh, this is an uneccesary move ig. Will be fixed when sending data from controller.

        $donation_types = array();
        foreach ($causes as $cause) {
            $donation_types[$cause->name] = $cause;
        }

        return view('frontend.donation.index', [
            'donation_types' => $donation_types,
            'causes' => $causes

        ]);
    }

    /**
     * campaigns - the page where users can donate money towards a campaign
     *
     * @param  mixed $request
     * @return void
     */
    public function campaigns($slug = null)
    {

        if($slug == null) {
            alert()->error('Whoops!', 'Campaign\'s slug missing. Try clicking on another one?');
            return redirect()->route('frontend.index');
        }

        # Prepare the
        $campaign = Campaigns::where(['slug' => $slug, 'campaign_status' => Campaigns::$status['ACTIVE'] ])->firstOrFail();

        $donation_details = array(
            'total' => 0,
            'donation_amount' => 0,
            'donation_percentage' => 0,
        );

        $donations = Donations::where('campaign_id', $campaign->id)->get();
        foreach ($donations as $donation) {
            $donation_details['total']++;
            $donation_details['donation_amount'] += $donation->donation_amount;
        }
        if($campaign->is_campaign_goal_based){
            $donation_details['donation_percentage'] = round(($donation_details['donation_amount'] / $campaign->campaign_goal_amount) * 100);
        }else{
            $donation_details['donation_percentage'] = 90;
        }

        return view('frontend.campaigns.index', compact('campaign', 'donation_details'));
    }

    /**
     * donate_process - The payment gateway page
     *
     * @param  mixed $razorpay_order_id
     * @return void
     */
    public function donate_process($razorpay_order_id = null)
    {

        if ($razorpay_order_id == null) {
            return redirect()->route('frontend.donate');
        }

        $order = app(RazorpayAPIController::class)->fetch_order($razorpay_order_id);

        if ($order['status'] == "paid"){
            return redirect()->route('frontend.donate');
        }
        //TODO Handle failure
        return view('frontend.donation.payment', [
            'order' => $order,

        ]);
    }

    /**
     * thank_you - A payment ID is required to enter this page
     *
     * @param  mixed $payment_id
     * @return void
     */
    public function thank_you($payment_id = null)
    {
        if ($payment_id == null) {
            return redirect()->route('frontend.donate')->with('error','Oops, you tried to visit the payment page without the proper ID. If you are unaware of the
            payment ID, please check the e-mail ID you provided during the time of donation. For more help, contact support.');
        }

        while (1){
            try {
                $id = Donations::where('razorpay_payment_id', $payment_id)->first()->id;
                break;
            }
            catch (\Exception $e) {
                sleep(1);
            }
        }

        return view('frontend.donation.thank_you', [
            'payment_id' => $payment_id,
            'payment' => app(RazorpayAPIController::class)->fetch_payment($payment_id),
            'id' => $id,
        ]);
    }


    /**
     * track_donation_footer_form - redirect the users from the frontend-footer.
     *
     * @param  mixed $request
     * @return void
     */
    public function track_donation_footer_form(Request $request) {

        // Validation will be handled in the next step.
        $tracking_id = $request->input('tracking-id');
        $url = route('frontend.track-donation'). '/' . $tracking_id;
        return redirect($url);
    }

    /**
     * track_donation - The page where users can track their donation
     *
     * @param  mixed $donation_id
     * @return void
     */
    public function track_donation($donation_id = null)
    {

        if($donation_id == null) {
            alert()->error('Whoops', 'In order to track a donation, you need to provide a proper donation ID');
            return redirect()->route('frontend.donate');
        }


        $donation = Donations::where('id', $donation_id)->first();

        # If the donation is not found, instead of throwing a blank 404, it gives a humane error.
        # - Leonard.
        if(!$donation) {
            alert()->error('Whoops', 'We were not able to fetch any donations with the ID of `'.$donation_id.'`. If you think this is a mistake, kindly contact us at the earliest convenience.');
            return redirect()->route('frontend.donate');
        }

        $operation = Operations::where('donation_id', $donation->id)->firstOrFail();


        # Activities

        $donation_activities = Activity::where('subject_type', 'App\Models\Donations')
            ->where('subject_id', $donation->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $operations_activities = Activity::where('subject_type', 'App\Models\Operations')
            ->where('subject_id', $operation->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        # Two levels of collection cuz once merged, the collection becomes an array.
        # - Leonard
        $merged_activities = collect(collect($donation_activities)->merge($operations_activities)->all())->sortBy([
            ['id', 'desc'],
            ['created_at', 'desc'],
        ]);

        return view('frontend.tracking.tracking', [
            'donation' => $donation,
            'operation' => $operation,
            'activities' => $merged_activities,
        ]);
    }



    public function faq()
    {

        $faq_categories = DB::table('faq_categories')->where('category_status', 1)->get();
        $faq_entries =   FaqEntries::get();
        // dd($faq_entries);
        // dd($faq_categories);
        return view('frontend.faq.index', ['faq_entries' => $faq_entries], ['faq_categories' => $faq_categories]);
    }

    public function contact()
    {

        return view('frontend.contact.contactus');
    }

    public function savecontact(Request $request)
    {

        $details = $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'message' => 'required|max:255',
        ]);


        Contact::create($details);

        SendConfirmationJob::dispatch($details);
        SendAdminJob::dispatch($details);



        return redirect()->back()->with('message', 'Your contact request has been sent to our team successfully. One of our representatives will contact you within 72 hours. Thank you');
    }

    // public function receipt()
    // {
    //     $data = [
    //         'donor_name' => 'Sathish',
    //         'donation_amount' => 10000,
    //         'donor_PAN' => 'AGB123OK12',
    //         'receiver_PAN' => 'AXI198OR19',
    //     ];

    //     $markdown = new Markdown(view(), config('mail.markdown'));
    //     // // return $markdown->render('receipt');

    //     $file_name = 'filename_' . date('d_m_Y_H_i_A');
    //     $html = $markdown->render('pdf.receipts.receipt', ['data' => $data]);

    //     Storage::disk('public')->put($file_name .'.html', $html);

    //     return PDF::loadFile(storage_path('app/public/' . $file_name . '.html'))
    //         ->setPaper('a4', 'portrait')
    //         ->stream($file_name . '.pdf');

    //     // $storage_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf');
    //     // $pdf = PDF::loadView('pdf.receipts.receipt', ['data' => $data])
    //     //     ->setPaper('a4', 'portrait')
    //     //     ->save($storage_path);


    //     // return view('receipt');
    //     // $pdf = PDF::loadView('receipt', $data);
    //     // return $pdf->download('receipts.pdf');
    // }

    /**
     * receipt - Generates the PDF directly on browser.
     *
     * @param  mixed $id
     * @return void
     */
    public function receipt($id)
    {

        if ($id == null) {
            return redirect()->route('frontend.donate');
        }

        $donation = Donations::where('id', $id)->firstOrFail();
        $user = User::find($donation->donor_id);
        $cause = $donation->cause_id ? Causes::find($donation->cause_id) : Campaigns::find($donation->campaign_id);
        $cause_name = $donation->cause_id ? 'cause '.$cause->name : 'campaign '.$cause->campaign_name;

        $payment['name'] = $user->name;
        $payment['date'] = date('d-m-Y', strtotime($donation->created_at));
        $payment['email'] = $user->email;
        $payment['phone'] = $user->phone_number;
        $payment['pan'] = $user->pan_number;
        $payment['donation_amount'] = $donation->donation_amount;
        $payment['amt_in_words'] = $donation->donation_in_words;
        $payment['quantity'] = $donation->cause_id ? (int) $donation->donation_amount / $cause->per_unit_cost : 1;
        $payment['amount'] = $donation->donation_amount;
        $payment['cause'] = $cause_name;
        $payment['receipt_no'] = $donation->id;
        $payment['razorpay_id'] = $donation->razorpay_payment_id;
        $payment['tracking_url'] = route('frontend.track-donation', $donation->id);

        $pdf = PDF::loadView('pdf.receipts.receipt', ['data' => [
            'payment' => $payment,
            'user' => $user,
        ]])->setPaper('a4', 'portrait')->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        /*

        Instead of having a job which generates bulky pdf files and then deletes them,
        we can have this view which can dynamically generate the receipt and display them
        Since it is a file stream the user can print/save/share etc without having to download the receipt
        This also solves the problem of storage space being exhausted

        The url for this would be /donations/receipt/{id}

        Anirudh R
        */

        $filename = 'donation_receipt_'.$donation->id.'.pdf';
        return $pdf->stream($filename);
    }


    // public function to show the policies/donation_policy page
    public function donation_policy()
    {
        return view('frontend.policies.donation_policy');
    }

    /**
     * activity
     *
     * @return void
     */
    public function activity() {
        return view('frontend.activity.index');
    }
}
