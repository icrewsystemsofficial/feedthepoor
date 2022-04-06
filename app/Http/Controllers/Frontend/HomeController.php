<?php

namespace App\Http\Controllers\Frontend;

use Faker\Factory;
use App\Models\Causes;
use App\Models\Location;
use App\Models\FaqCategories;
use App\Models\FaqEntries;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\RazorpayAPIController;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendAdminJob;
use App\Jobs\SendConfirmationJob;
use Illuminate\Support\Facades\Storage;
use PDF;

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

        $total_meals_fed = 850;
        $total_donations_received = 42500;
        $howmany = 50;

        $images = array();
        $height = 300;
        for ($i = 0; $i < $howmany; $i++) {
            $url = "https://picsum.photos/800/" . $height . "";
            $images[$i] = $url;
            $height++;
        }


        $names = array();
        $faker = Factory::create('en_IN');
        for ($i = 0; $i < $howmany; $i++) {
            $names[$i] = $faker->firstName;
        }

        $donation_random_images = json_encode($images);
        $donation_names = json_encode($names);

        $causes = Causes::all();
        

        return view('frontend.index', [
            'donation_images' => $donation_random_images,
            'donation_names' => $donation_names,
            'total_meals_fed' => $total_meals_fed,
            'total_donations_received' => $total_donations_received,
            'causes' => $causes
        ]);
    }

    public function about()
    {

        $locations = Location::where('location_status', 1)->get();

     

        return view('frontend.about.index', [
            'locations' => $locations,
           
        ]);
    }

    public function partners () {
        return view('frontend.partners.index');
    }

    public function volunteer()
    {
        $causes = Causes::all();   
        return view('frontend.volunteer.index' , ['causes' => $causes]);
    }
    /**
     * donate - the page where users can donate money.
     *
     * @return void
     */
    public function donate()
    {
        $causes = Causes::all();


        // Argh, this is an uneccesary move ig. Will be fixed when sending data from controller.

        $donation_types = array();
        foreach ($causes as $cause) {
            $donation_types[$cause->name] = $cause;
        }

        return view('frontend.donation.index', [
            'donation_types' => $donation_types,
            
            
        ]);
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
     
        return view('frontend.donation.thank_you', [
            'payment_id' => $payment_id,
            'payment' => app(RazorpayAPIController::class)->fetch_payment($payment_id),
          
        ]);
    }


    // function created by sathish
    public function track_donation($donation_id = '')
    {

       
        $faker = Factory::create('en_IN');
        $donation_name = $faker->firstName();

        // dd($names_json);
        return view('frontend.tracking.tracking', [
            'donation_name' => $donation_name,
          
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

    public function receipt()
    {
        $data = [
            'donor_name' => 'Sathish',
            'donation_amount' => 10000,
            'donor_PAN' => 'AGB123OK12',
            'receiver_PAN' => 'AXI198OR19',
        ];

        $markdown = new Markdown(view(), config('mail.markdown'));
        // // return $markdown->render('receipt');

        $file_name = 'filename_' . date('d_m_Y_H_i_A');
        $html = $markdown->render('pdf.receipts.receipt', ['data' => $data]);

        Storage::disk('public')->put($file_name .'.html', $html);

        return PDF::loadFile(storage_path('app/public/' . $file_name . '.html'))
            ->setPaper('a4', 'portrait')
            ->stream($file_name . '.pdf');

        // $storage_path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'receipts' . DIRECTORY_SEPARATOR . $file_name . '.pdf');
        // $pdf = PDF::loadView('pdf.receipts.receipt', ['data' => $data])
        //     ->setPaper('a4', 'portrait')
        //     ->save($storage_path);


        // return view('receipt');
        // $pdf = PDF::loadView('receipt', $data);
        // return $pdf->download('receipts.pdf');
    }
}
