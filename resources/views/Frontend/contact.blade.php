@section('meta')
<title>
    Contact us | FeedThePoor - Donate money confidently and Transparently
</title>
@endsection



@section('title')

@endsection



@section('css')

@endsection



@section('content')
<BR><BR>
<BR>
<BR>

<div class="bg-white">
                    <h1 class="display-4 text-center">Contact Us</h1>
                    <p class="text-center">
                        Fill this up and we'll be right with you within the next 24-48 working hours.
                    </p>
                    <br><br>
<div class="contact-form padding-top60 padding-bottom60 ">
        <div class="custom-width">

            <div class="row">
                <div class="col-6 m-5" wfd-id="102">
                    <img style="height: 350px; width: auto;" src="https://cdn.discordapp.com/attachments/741259606512107602/745210919029702716/20200818_144926.jpg" class="img-center img-fluid rounded z-depth-3 z-depth-3" alt="">
                </div>
                <div class="col-4">
<div class="card w-100 rounded z-depth-3 z-depth-3 ">
                    <form method="POST" class="p-4 mt-2" action="{{ route('contact.register') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group ml-3 mr-3">
                                        <input type="text" class="form-control form-control-user bg-muted" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required="required" data-error="Name is required" autofocus>
                                    </div>

                                    <div class="form-group ml-3 mr-3">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required="required" data-error="Email is required">
                                    </div>
                                    <div class="form-group ml-3 mr-3">
                                        <textarea class="form-control form-control-user" name="message" placeholder="Your Message" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group ml-3 mr-3">
                                        <div class="g-recaptcha" data-sitekey="6LccmJ0aAAAAANC3BiSiBOLmaUCz9donN4zAEXD7"></div>
                                    </div>
                                    <div class="form-group ml-3 mr-3">
                                        <button class="btn  btn-large"> <span class="fa fa-envelope"></span>

                                        {{ __('Send Message') }}
                                        </button>
                                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
 </div>
 </div>
 <br>
 <br>
 <br>
@endsection



@section('js')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection