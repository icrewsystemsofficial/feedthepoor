<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Mail\AdminReply;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    public function index(){
        return view('dashboard.contact_admin');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index1($id){
        //return view('dashboard.contact_admin_edit');
      //  return Contact::find($id);
        $data=Contact::find($id);
        return view('dashboard.contact_admin_edit',compact('data'));

    }

    public function fetch(){
        $data = Contact::all();
        return view ('dashboard.contact_admin' )->with('data', $data );
    }

    public function update(Request $req){
        $data=Contact::find($req->id);
        $data->reply=$req->input('reply');

        if($req->hasFile('files')){
            $data->files= $req->file('files')->store('storage');
        }

        $data->status= $req->input('status');
        $data->save();
        notify()->success("Successfully Noted!","Reply");
        Mail::to($data->email)->send(new AdminReply($data));
        return redirect(route('contactadmin.fetch'));
    }

}
