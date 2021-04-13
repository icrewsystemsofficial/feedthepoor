<?php

namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index(){
        return view('frontend.contact');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:8','max:500'],
        ]);


    $contact =new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->files = "";
        $contact->reply = "";
        $contact->status = "";
        $contact->save();

        return redirect()->route('contact')->withSuccess('Profile updated successfully.');
    }


}
