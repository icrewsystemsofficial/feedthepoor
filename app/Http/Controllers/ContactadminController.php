<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;


class ContactAdminController extends Controller
{
    public function index(){
        return view('dashboard.contact_admin');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetch(){
        $data = contact::all();
        return view ('dashboard.contact_admin' )->with('data', $data );
    }
     public function update(Request $req){
        $data = contact::find($req->id);
        $data->name = ($req->name);
        $data->email =($req->email);
        $data->reply= ($req->reply);
        //$data->files= ($req->files)->getClientOriginalName();
        $data->status= ($req->status);
        $data->save();
        dd($data);

        $mail=($req->email);
        dd($mail) ;
        return  $req->files('files')->store('docs');
        $data=[ 'file'=>$req->files('files')];
        //Mail::to($mail)->send(new Contactmail($data));
        //return redirect()->route('contact')->withSuccess('contact updated successfully.');
    }

}
