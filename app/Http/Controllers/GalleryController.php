<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery() {
        return view('home.gallery');
    }
  
    public function upload(Request $request){

        if ($request->hasFile('image')){
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('Galleryimages',$filename,'public');
        //stores in storage/app/public/Galleryimages
        }

        return redirect()->back()->with("success","uploaded sucessfully");
           
    }

    public function galleryupload(){
        return view('admin.Gallary.upload');
    }

}
