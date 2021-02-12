<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\addvolunteers;

class addvolunteersController extends Controller
{
 
    public function index()
    {
        return view('admin/volunteers/addvolunteers');
    }
    public function store(Request $request)
    {
        $addvolunteers = new addvolunteers();
        $addvolunteers->name = $request->input('name'); 
        $addvolunteers->location = $request->input('location'); 
        $addvolunteers->desc = $request->input('desc'); 
        $addvolunteers->facebook = $request->input('facebook'); 
        $addvolunteers->instagram = $request->input('instagram'); 
        $addvolunteers->linkedin = $request->input('linkedin'); 
        $addvolunteers->image = $request->input('image'); 

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/addvolunteers/', $filename);
            $addvolunteers->image = $filename;


        }
        else{

            return $request;
            $addvolunteers->image = '';

        }

        $addvolunteers->save();
        return view('admin/volunteers/addvolunteers')->with('addvolunteers', $addvolunteers);
    }
    public function display()
    {

        $addvolunteersform = addvolunteers::all();
        return view('admin/volunteers/addvolunteersform')->with('addvolunteersform',$addvolunteersform);
    }

    
    // public function edit($id)
    // {

    //     $addvolunteersform = addvolunteers::find($id);
    //     return view('admin/volunteers/volunteersupdateform')->with('addvolunteersform',$addvolunteersform);
    // }
    // public function update(Request $request, $id)
    // {
    //     $addvolunteersform = addvolunteers::find($id);

    //     $addvolunteersform->name = $request->input('name'); 
    //     $addvolunteersform->location = $request->input('location'); 
    //     $addvolunteersform->image = $request->input('image'); 

    //     if ($request->hasfile('image')) {
    //         $file = $request->file('image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move('uploads/addvolunteers/', $filename);
    //         $addvolunteersform->image = $filename;


    //     }
        

    
    //     $addvolunteersform->save();
    //     return redirect('admin/volunteers/addvolunteersform')->with('addvolunteersform', $addvolunteersform);
    // }
  
    
    public function delete($id)
    {
        $addvolunteersform = addvolunteers::find($id);
        $addvolunteersform->delete();


        return redirect('admin/addvolunteersform')->with('addvolunteersform', $addvolunteersform);
    }
}
