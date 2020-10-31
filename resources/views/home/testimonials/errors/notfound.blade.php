@extends('layouts.layouts')
@section('content')
<section class="slice-lg">
       <div class="container">
         <div class="row py-5 align-items-center cols-xs-space cols-sm-space cols-md-space">
           <div class="col-lg-6">
             <div class="d-flex align-items-start">
               <div class="icon-text">
                 <h3 class="heading">
                   Whoopsie!
                 </h3>
                 <p>
                   We couldn't find a testimonial with those details!
                   <br /><br /><br />
                   <a href="{{ url('/') }}" class="btn btn-sm btn-danger">Go home</a>
                 </p>
               </div>
             </div>
           </div>

           <div class="col-md-6">
             <img src="https://cdn.dribbble.com/users/10549/screenshots/3062682/build.png" class="img-center img-fluid rounded z-depth-3"/>
           </div>

          </div>
       </div>
   </section>
@endsection
