<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\GalleryImage;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function gallery() {
        $gallery = GalleryImage::all();
        return view('home.gallery',['galleryimages'=>$gallery]);
    }

    public function upload(Request $request){

        if ($request->hasFile('image')){
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('Galleryimages',$filename,'public');
        DB::insert('insert into gallery_images (name) values (?)', [$filename]);
        //stores in storage/app/public/Galleryimages
        }

        return redirect()->back()->with("success","uploaded sucessfully");

    }

    public function galleryupload(){
        return view('admin.Gallary.upload');
    }

}

