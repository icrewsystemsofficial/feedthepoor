<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Donation;
use App\Volunteer;
use App\Partner;
use App\Testimonial;
use Illuminate\Support\Facades\Mail;




class HomeController extends Controller
{
    public function index() {
      //Create views in resources/home. - Leonard Selvaraja.
      //Take 5 recent hero section testimonials to display on the home page.
      $testimonials = Testimonial::where('status',2)->inRandomOrder()->take(5)->get();
      return view('home.index',['testimonials'=>$testimonials]);
    }

    public function comingsoon() {
      return view('home.comingsoon');
    }


    //SAURABH
    public function faq() {
      //FAQ to be done by Saurabh.
      return view('home.faq');
    }

    public function aboutus() {
      return view('home.aboutus');
    }


    //THARUN.
    public function success() {
      // When Payment is successful.
      return view('home.success');
    }

    public function error() {
      // When Payment is not successful.
      return view('home.error');
    }

    //Bharath
    public function testimonials() {
      // Testimonials
      $testimonials = Testimonial::whereIn('status',[1,2])->inRandomOrder()->take(7)->get();
      return view('home.testimonials.list', ['testimonials'=>$testimonials]);
    }

    public function addtestimonial() {
      // Testimonials
      $testimonials = Testimonial::where('status',2)->inRandomOrder()->take(5)->get();
      return view('home.testimonials.add', ['testimonials'=>$testimonials]);
    }

    public function testimonialVerify(Request $request) {
      $response = array();

      //Checking the DB.
      $check = Donation::where('donor_email', $request->email)->first();
      if($check) {
        $response['status'] = '200';
        $response['message'] = 'Your donation was verified. You may now proceed to submit your testimonial.';
        $response['name'] = $check->donor_name;
        $response['email'] = $check->donor_email;
      } else {
        $response['status'] = '404';
        $response['message'] = 'No donation was found with the email '.$request->email.'. If you think this is a mistake, please contact us.';
      }

      // 200 - Shows success Swal.
      // 404 - shows error swal.
      // Message - is directly handled by axios, and passed into swal.
      //
      //This status code is different from the HTTP status code. The HTTP code
      //will always return 200 if the request was successful, and we need axios to handle
      //the 404 response inside the first codeblock of the conditional statement, hence we use
      //this method of making our own status code inside the response.data.status var.
      //
      //
      // -Leonard, 23/10/2020.
      return response($response);
    }

    public function viewtestimonial($id)
    {
      $id = Crypt::decryptString($id);
      $testimonial = Testimonial::find($id);
      if(!$testimonial)
      {
        return view('home.testimonials.errors.notfound');
      }
      else
      {
        return view('home.testimonials.view',['testimonial'=>$testimonial]);
      }
    }

    public function work() {
      // Testimonials
      return view('home.work');
    }

    public function volunteers(Request $request) {
      // Volunteers
      /*$volunteer = new Volunteer;
      $volunteer->first_name = $request->input('first_name');
      $volunteer->last_name = $request->input('last_name');
      $volunteer->dob = $request->input('DOB');
      $volunteer->state = $request->input('state');
      $volunteer->city = $request->input('city');
      $volunteer->zip = $request->input('zip');
      $volunteer->current_institution = $request->input('current_institution');
      $volunteer->contact_number = $request->input('contact');
      $volunteer->email = $request->input('email');
      $volunteer->comments = $request->input('comments');


      $volunteer->save();*/

      return view('home.volunteers');

    }

    public function partners(Request $request) {
      // Partners
      /*$partner = new Partner;
      $partners->organisation_name = $request->input('organisation_name');
      $partners->organisation_address = $request->input('organisation_address');
      $partners->state = $request->input('state');
      $partners->city = $request->input('city');
      $partners->zip = $request->input('zip');
      $partners->contact = $request->input('contact');
      $partners->email = $request->input('email');
      $partners->comments = $request->input('comments');


      $partner->save();*/

      return view('home.partners');

    }

    public function partnerssuccess() {
      //Bharath
        notify()->success('You are Successfully registered as a Partner', 'Yay!');
      return view('home.partnerssuccess');
    }



    public function volunteerssuccess() {
      //Bharath
        notify()->success('You are Successfully registered as a Volunteer', 'Yay!');
      return view('home.volunteerssuccess');
    }

    public function contacts(Request $request) {
      // contacts
      //  $contact = new contact;
      // $contacts->first_name = $request->input('first_name');
      // $contacts->contact = $request->input('contact');
      // $contacts->email = $request->input('email');
      // $contacts->subject = $request->input('subject');
      // $contacts->comments = $request->input('comments');


      // $partner->save();
      // \Mail::to($request->input('email'))->send(new Contact($request->input()));

      return view('home.contacts');

    }

    public function contactsuccess() {
      //Bharath
        notify()->success('Thank you for Contacting Us', 'Yay!');
      return view('home.volunteerssuccess');
    }

    public function testimonialsuccess(Request $request) {
      // Apoorv: Handle when a testimonial is submitted from the frontend form.
      $validatedData = $request->validate([
        'full_name' => 'required|max:255',
        'email' => 'required|email',
        'message' => 'required',
      ]);
      //Check if hashed email is present atleast once in Donations table.
      $num_donations = Donation::where('donor_email',$request->email)->count();
      if($num_donations>0)
      {
        //If donated atleast once, submit testimonial to database.
        $testimonial = new Testimonial;
        $testimonial->name = $request->full_name;
        $testimonial->email = $request->email;
        $testimonial->message = $request->message;
        $testimonial->status = 0;
        $testimonial->save();
        //Return back to the testimonials page with success message.
        return redirect()->back()->with('success', 'Successfully Submitted');
      }
      else
      {
        // Return Error that No Donation was found with this email. Provide button to encourage donations. Error Code is sample. Can be changed once project error documentation is ready.
        return redirect()->back()->withErrors(['general'=>'Code 101','general_title' => 'We couldn\'t find a donation from this email!','general_msg' => 'We couldn\'t find any donation from this email ID. Haven\'t donated yet? Try donating using the button below.', 'btn_text' => 'Donate Now', 'btn_link' => url('/money')]);
      }
      //return view('home.comingsoon');
      //return dd($request);
    }


    public function mission() {
      return view('home.mission');
    }

}
