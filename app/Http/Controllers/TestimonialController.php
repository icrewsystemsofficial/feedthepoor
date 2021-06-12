<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use Auth;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // return view('dashboard.testimonial');

        $testimonials = Testimonial::where('user_id','=',Auth::user()->id)->get(); //to retreive testimonial specific to the logged in user

        //for admin view , select $testimonials= Testimonial::all();

        return view('testimonials.index')
            ->with('testimonials',$testimonials);
    }

    public function adminIndex(){

        $testimonials= Testimonial::all();
        
        return view('testimonials.admin.index')
            ->with('testimonials',$testimonials);
    }

    public function create()
    {
        return view('testimonials.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'message'=>'required'
        ]);

        Testimonial::create($request->all());

        return redirect()->route('testimonial')
            ->with('success','Testimonial created successfully.');
    }

    public function status(Request $request)
    {
        $testimonial = Testimonial::find($request->id);

        if($testimonial){
            if($testimonial->status_id == 0){
                $testimonial->update(['status_id'=>1]);
                notify()->success('Testimonial Status Changed', 'Enabled!');
            }else{
                notify()->success('Testimonial Status Changed', 'Disabled!');
                $testimonial->update(['status_id'=>0]);
            }
            return redirect(route('testimonials.admin.index'));
        }else{
            notify()->success('Testimonial was not found.', 'Not Found!');
            return redirect(route('testimonials.admin.index'));
        }
    }


    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit',['testimonial' => $testimonial]);
    }

    public function update(Request $request)
    {
        $request->validate([

        ]);

        $testimonial = Testimonial::find($request->id);
        
        $testimonial->update($request->all());

        return redirect()->route('testimonial')
            ->with('success','Testimonial Updated Successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonial')
            ->with('success','Testimonial deleted successfully');
    }
    
}
