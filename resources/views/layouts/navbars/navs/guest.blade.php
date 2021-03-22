<!-- Navbar -->
<nav class="navbar navbar-expand-md  py-3 navbar-dark bg-white ">

    <a class="navbar-brand text-dark h4" style="margin-left:110px;" href="#"><strong>#feed</strong>ThePoor</a>
  
    <div class="collapse navbar-collapse  " id="navbar_example_1">
        <ul class="navbar-nav ml-auto "  >
            <li class="nav-item active" >
                <a class="nav-link text-dark"  href="#"> Who did we feed today? </a>
            </li>
           
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbar_1_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
                <div class="dropdown-menu" aria-labelledby="navbar_1_dropdown_1">
                    <a class="dropdown-item text-dark" href="#">About us</a>
                    <a class="dropdown-item text-dark" href="#">How does it work</a>
                    <a class="dropdown-item text-dark" href="#">Volunteers</a>
                    <a class="dropdown-item text-dark" href="#">Partners</a>  
                    <a class="dropdown-item text-dark" href="#">Testimonials</a>  

            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Contact</a>
            </li>
        </ul>
        <!--button type="button" style="margin-right:150px;" class="btn  btn-primary btn-sm btn-animated btn-animated-y">
            <span class="btn-inner--visible">Donate Now</span>
            <span class="btn-inner--hidden"><i class="fas fa-arrow-right"></i></span>
        </button-->
        @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn-sm btn-light" href="{{ route('home') }}">Home</a>
                    @else
                        <a class="btn  btn-primary btn-sm btn-animated btn-animated-y" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="btn  btn-primary btn-sm btn-animated btn-animated-y" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </div>
</nav>
<!-- End Navbar -->
