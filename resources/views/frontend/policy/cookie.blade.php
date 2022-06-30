@extends('layouts.frontend')

@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')

<section class="section section-header text-white hero-header">
    <div class="container" style="position: relative;z-index: 2;">
        <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
                <h1 class="display-3 mb-4">
                   Cookie Policy
                </h1>
                <p class="lead mb-4 text-muted">
                    By accessing this website we assume you accept these terms and conditions in full
                </p>
                <a href="#policy" class="btn btn-tertiary me-3 animate-up-2">
                    Read More <span class="ms-2"><span class="fas fa-arrow-down"></span></span>
                </a>
            </div>
       </div>
    </div>
</section>
<section class="section bg-gray-200" id="policy">
    <div class="container  z-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card border-gray-300 p-4 p-md-5">
                    <h2 class="mb-3">Our Policy</h2>
                    <p> This is the Cookie Policy for Feed The Poor, accessible from feedthepoor.icrewsystems.org
                    </p>
                    <h3 class="font-weight-bold">
                        What are cookies ?
                    </h3>
                    <p>
                        As is common practice with almost all professional websites this site uses cookies, which are tiny files that are downloaded to your computer, to improve your experience. This page describes what information they gather, how we use it and why we sometimes need to store these cookies. We will also share how you can prevent these cookies from being stored however this may downgrade or 'break' certain elements of the sites functionality.
                        <br><br>
                        For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/">"What Are Cookies"</a>. Information regarding cookies from this Cookies Policy are from the <a href="https://www.generateprivacypolicy.com/">Privacy Policy Generator</a>.
                    </p>

                    <h3>How We Use Cookies</h3>
                    <p>
                        We use cookies for a variety of reasons detailed below. Unfortunately in most cases there are no industry standard options for disabling cookies without completely disabling the functionality and features they add to this site. It is recommended that you leave on all cookies if you are not sure whether you need them or not in case they are used to provide a service that you use.
                    </p>
                    <h3 class="font-weight-bold">Disabling Cookies</h3>
                    <p>You can prevent the setting of cookies by adjusting the settings on your browser (see your browser Help for how to do this). Be aware that disabling cookies will affect the functionality of this and many other websites that you visit. Disabling cookies will usually result in also disabling certain functionality and features of the this site. Therefore it is recommended that you do not disable cookies. This Cookies Policy was created with the help of the <a href="https://www.cookiepolicygenerator.com/cookie-policy-generator/">
                    Cookies Policy Generator from CookiePolicyGenerator.com.</a></p>

                    <h3>The Cookies We Set</h3>
                    <p>
                        <ul>
                            <li> <h5>Acccount related cookies </h5></li>

                            <p>If you create an account with us then we will use cookies for the management of the signup process and general administration. These cookies will usually be deleted when you log out however in some cases they may remain afterwards to remember your site preferences when logged out.
                            </p>
                        </ul>
                        <ul>
                            <li><h5>Login related cookies</h5></li>

                            <p>We use cookies when you are logged in so that we can remember this fact. This prevents you from having to log in every single time you visit a new page. These cookies are typically removed or cleared when you log out to ensure that you can only access restricted features and areas when logged in.</p>
                        </ul>
                        <ul>
                            <li><h5>Email newsletters related cookies</h5></li>

                            <p>This site offers newsletter or email subscription services and cookies may be used to remember if you are already registered and whether to show certain notifications which might only be valid to subscribed/unsubscribed users.</p>
                        </ul>

                        <ul>
                            <li><h5>Orders processing related cookies</h5></li>

                            <p>This site offers e-commerce or payment facilities and some cookies are essential to ensure that your order is remembered between pages so that we can process it properly.
                            </p>
                        </ul>

                        <ul>
                            <li><h5>Surveys related cookies</h5></li>

                            <p>From time to time we offer user surveys and questionnaires to provide you with interesting insights, helpful tools, or to understand our user base more accurately. These surveys may use cookies to remember who has already taken part in a survey or to provide you with accurate results after you change pages.
                            </p>
                        </ul>

                        <ul>
                            <li><h5>Forms related cookies</h5></li>

                            <p>When you submit data to through a form such as those found on contact pages or comment forms cookies may be set to remember your user details for future correspondence.
                            </p>
                        </ul>
                        <ul>
                            <li><h5>Site preferences cookies</h5></li>

                            <p>In order to provide you with a great experience on this site we provide the functionality to set your preferences for how this site runs when you use it. In order to remember your preferences we need to set cookies so that this information can be called whenever you interact with a page is affected by your preferences.
                            </p>
                        </ul>
                    </p>

                    <h3 class="font-weight-bold">Third Party Cookies</h3>
                    <p>In some special cases we also use cookies provided by trusted third parties. The following section details which third party cookies you might encounter through this site.
                       <ul>
                           <li>
                               From time to time we test new features and make subtle changes to the way that the site is delivered. When we are still testing new features these cookies may be used to ensure that you receive a consistent experience whilst on the site whilst ensuring we understand which optimisations our users appreciate the most.
                           </li>
                        </ul>
                    </p>
                    <h3 class="font-weight-bold">More Information</h3>
                    <p>Hopefully that has clarified things for you and as was previously mentioned if there is something that you aren't sure whether you need or not it's usually safer to leave cookies enabled in case it does interact with one of the features you use on our site.
                    <br>
                    However if you are still looking for more information then you can contact us by clicking the below link
                    <a href="{{ route('frontend.contact') }}">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection