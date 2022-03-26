@if(!in_array(Route::currentRouteName(), ['frontend.donate', 'frontend.donate.payment', 'frontend.donate.thank_you']))
<section class="section py-0">
    <div class="container z-2">
       <div class="row position-relative justify-content-center align-items-center">
          <div class="col-12">
             <!-- Card -->
             <div class="card px-4 py-1 border-dark bg-theme">
                <div class="card-body text-center text-md-left">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <h2 class="h1 mb-3">
                                It only takes ₹50 🙏
                            </h2>

                            <p class="lead">
                                Our donation window for {{ now()->addDay(1)->format('d F, Y') }} is open.
                            </p>

                            <p class="mb-4">
                                If you are able to, please consider donating. If you're not able to donate,
                                <span class="fw-bolder">share this website</span> with others who might be able to donate.
                            </p>

                            <a href="#" class="btn btn-primary me-2">
                                <span class="me-1">
                                    <span class="fas fa-arrow-right"></span>
                                </span>
                                Donate Now
                            </a>

                            <a href="#" class="btn btn-primary btn-white">
                                <span class="me-1">
                                    <span class="fas fa-share"></span>
                                </span>
                                Share website
                            </a>
                        </div>

                        {{-- <div class="col-12 col-md-6 mt-5 mt-md-0 text-md-right">
                            <img src="../../assets/img/illustrations/reading-side.svg" alt="">
                        </div> --}}

                    </div>
                </div>
            </div>
          </div>
       </div>
    </div>
</section>
@endif

<footer class="footer pt-6 pb-5 bg-gray text-white mt-n6">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                {{-- <img class="navbar-brand-dark mb-4" height="35" src="../../assets/img/brand/light.svg"
                    alt="Logo light"> --}}

                LOGO

                <p>
                    {{ config('setting.app_description') }}

                    <hr>

                    ADDRESS OF THE NGO!

                </p>

                <ul class="social-buttons mb-5 mb-lg-0">
                    <li>
                        <a href="https://instagram.com/" aria-label="github social link" class="icon-white me-2">
                            <span class="fab fa-instagram"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" aria-label="twitter social link"
                            class="icon-white me-2">
                            <span class="fab fa-twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com//" class="icon-white me-2"
                            aria-label="facebook social link">
                            <span class="fab fa-facebook"></span>
                        </a>
                    </li>
                </ul>


            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">QUICKLINKS</span>
                <ul class="footer-links mt-2">
                    <li><a target="_blank" href="#">Track Donation</a></li>
                    <li><a target="_blank" href="{{ route('frontend.volunteer') }}">Volunteer</a></li>
                    <li><a target="_blank" href="#">View Certifications</a></li>
                    <li><a target="_blank" href="#">Transparency Reports</a></li>
                    <li><a target="_blank" href="#">Request for food</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5 mb-lg-0">
                <span class="h5">Support</span>
                <ul class="footer-links mt-2">
                    <li>
<<<<<<< HEAD
                        <a href="{{route('frontend.faq')}}">F.A.Q</a>
                    </li>
                    <li>
                        <a href="{{route('frontend.contact')}}"> Contact Us </a>
=======
                        <a href="{{ route('frontend.faq') }}">F.A.Q</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.contact') }}">Contact Us</a>
>>>>>>> 03944227ffff924332ec565735b0b7cce60c9a3f
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-4 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-12">
                        <div style="max-width: 341px; margin: 0px auto;">
                            <div style="position: relative; padding-top: 100%;">
                                <iframe style="background: transparent none repeat scroll 0% 0% !important; position: absolute; left: 0px; top: 0px;" scrolling="no" allowtransparency="true" src="//rf.revolvermaps.com/w/6/a/c2.php?i=5rmj73h4zxx&amp;m=0c&amp;c=ff0000&amp;cr1=ffffff&amp;f=calibri&amp;l=1&amp;v0=20&amp;lx=60&amp;ly=-160&amp;he=3&amp;cw=ffffff&amp;cb=152230" width="100%" height="100%" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-muted font-small m-0">
                    We exist, because of the kindness of people around the world.
                </p>
            </div>
        </div>
        <hr class="bg-secondary my-3 my-lg-5">
        <div class="row">
            <div class="col mb-md-0">
                <a href="#" target="_blank" class="d-flex justify-content-center mb-3">
                    {{-- <img src="{{ asset('theme/assets/img/themesberg.svg') }}" height="30" class="me-2" alt="Themesberg Logo"> --}}
                    <p class="text-white fw-bold footer-logo-text m-0">
                        {{ config('setting.app_name')}} &copy; {{ date('Y') }}, All rights reserved
                    </p>
                </a>
                <div class="d-flex text-center justify-content-center align-items-center" role="contentinfo">
                    <p class="fw-normal font-small mb-0">
                        This website is developed & maintained with <i class="fas fa-heart mr-1 ml-1"></i> by <a href="https://icrewsystems.com?ref={{ config('app.url') }}" target="_blank" class="fw-bolder underline">icrewsystems</a> for free-of-charge
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
