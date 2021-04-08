<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;


class ContactAdminController extends Controller
{
    public function index(){
        return view('dashboard.contact_admin');
    }

    public function fetch(){
        $data = contact::all();
        return view ('dashboard.contact_admin' )->with('data', $data );
    }
     public function update(Request $req){
       dd($req);
        $data = contact::find($req->id);
        $data->message=$req->fenquiry;
        $data->reply=$req->freply;
        $data->files=$req->ffiles;
        $data->status=$req->fstatus;
        $data->save();

    }

}
