<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class TestimonialController extends Controller
{
    public function index(){
        // return view('dashboard.testimonial');

        $testimonials = Testimonial::latest()->paginate(5);
        return view('testimonials.index',compact('testimonials'))
            ->with('i',(request()->input('page',1) - 1) * 5);
    }

    public function create()
    {
        return view('testimonials.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'message'=>'required'
        ]);

        Testimonial::create($request->all());

        return redirect()->route('testimonial')
            ->with('success','Testimonial created successfully.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show',compact('testimonials'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit',['testimonial' => $testimonial]);
    }

    public function update(Request $request,Testimonial $testimonial)
    {
        $request->validate([

        ]);
        
        $testimonial->update($request->all());

        return redirect()->route('/testimonial')
            ->with('success','Testimonial Updated Successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonial')
            ->with('success','Testimonial deleted successfully');
    }
    
}
