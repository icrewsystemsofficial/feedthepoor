@extends('layouts.layouts')
@section('js')
<script type="text/javascript">
    function copyLink() {
        navigator.clipboard.writeText("{{ url('/testimonials/view/'.$testimonial->slug) }}");
        swal.fire({
            icon: 'success',
            title: 'Link copied to clipboard!'
        });
    }
</script>
@endsection
@section('content')
<section class="slice slice-xl bg-secondary">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                {{ $testimonial->created_at->diffForHumans() }}, {{ $testimonial->name }} said <br />
                <h4 class="">{{ $testimonial->message }}</h4>

                <br />
                @if($testimonial->status == 2)
                  <span class="badge badge-warning"><i class="fa fa-star"></i> FEATURED</span>
                @endif
                </p>
            </div>
        </div>
    </div>
</section>

<section class="slice slice-xl">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <p class="lead mt-3 lh-180 animated" data-animation-in="fadeInUp" data-animation-delay="2500">
                    <span style="font-size: 2.2rem;">
                        <strong>#feedThePoor</strong> <i class="fa fa-heart text-danger"></i> {{ $testimonial->name }}
                    </span> <br />

                    <span class="text-muted">
                        When you share a testimonial it goes a long way, you inspire another person to donate and #feedThePoor.
                    </span>

                    <br /><br />
                    <a href="{{ url('/testimonials/add') }}" class="btn btn-sm btn-success btn-hover">
                        Write a testimonial
                    </a>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-secondary">
                            <div class="card-body">
                                <h2 class="heading pt-3 pb-2">
                                Share this Testimonial<br />
                                </h2>
                                <p class="mb-5">
                                Sharing is fabulous! Each share helps us reach and inspire so many more changemakers!
                                </p>
                                <a class="btn btn-slack btn-icon-only btn-circle rounded-circle" href="https://wa.me/?text={{ urlencode('*'.$testimonial->name.'* says
"'.\Illuminate\Support\Str::limit($testimonial->message,75).'"
'.url('/testimonials/view/'.$testimonial->slug)) }}" data-action="share/whatsapp/share" target="_blank">
                                    <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                                </a>
                                <a class="btn btn-twitter btn-icon-only btn-circle rounded-circle" href="https://twitter.com/intent/tweet?text={{ urlencode($testimonial->name.' says,
"'.\Illuminate\Support\Str::limit($testimonial->message,75).'"
#feedThePoor
'.url('/testimonials/view/'.$testimonial->slug)) }}" target="_blank">
                                    <span class="btn-inner--icon"><i class="fab fa-twitter"></i></span>
                                </a>
                                <a class="btn btn-facebook btn-icon-only btn-circle rounded-circle" href="https://www.facebook.com/sharer/sharer.php?u={{ url('/testimonials/view//'.$testimonial->slug) }}&t={{ urlencode('Testimonial at #feedThePoor') }}" target="_blank">
                                    <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
                                </a>
                                <a class="btn btn-tertiary btn-icon-only btn-circle rounded-circle" href="#" onClick="copyLink();">
                                    <span class="btn-inner--icon"><i class="fa fa-link"></i></span>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
