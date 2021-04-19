<?php

namespace App\Http\Controllers;
use App\Gallery;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index(){
        return view('dashboard.gallery');
    }
    public function register(Request $request)
    {
        $request->validate([
            'caption' => ['required', 'string', 'max:255'],
            'active' => ['required', 'string',  'max:255'],
            'files' => ['required'],
        ]);


    $data =new Gallery;
        $data->caption = $request->input('caption');
        $data->active = $request->input('active');
       
        if($request->hasFile('files')){
            $data->photo= $request->file('files')->store('storage');
        }

        $data->save();
        notify()->success("Your photo has been saved!","Success");
        return redirect()->route('gallery');
    }

}
