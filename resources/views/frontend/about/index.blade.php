@extends('layouts.frontend')

@section('content')
    <!-- Hero -->
    <section class="section-header bg-secondary text-white">
        <div class="container">
           <div class="row justify-content-between align-items-center">
              <div class="col-12 col-md-7 col-lg-6 text-center text-md-left">
                    <h1 class="display-2 mb-4">
                        Full-Service <br class="d-none d-md-inline">Digital Agency
                    </h1>
                    <p class="lead mb-4 text-muted">Themesberg can help you build a modern website, a creative logo or PWA, that will bring you customers and and stay on top of your competition.</p>
                    <a href="./services.html" class="btn btn-tertiary me-3 animate-up-2">What we do <span class="ms-2"><span class="fas fa-arrow-right"></span></span></a>
                </div>
              <div class="col-12 col-md-5 d-none d-md-block text-center"><img src="../../assets/img/illustrations/about-illustration.svg" alt=""></div>
           </div>
        </div>
    </section>
    <!-- End of Hero section -->
    <!-- Section -->
    <section class="section section-md">
        <div class="container">
            <div class="row align-items-center justify-content-around">
                <div class="col-md-6 col-xl-6 mb-5">
                    <img class="organic-radius img-fluid" src="../../assets/img/sections/about-us-1.jpg" alt="Office Desk">
                </div>
                <div class="col-md-6 col-xl-5 text-center text-md-left">
                    <h2 class="h1 mb-5">All challenges accepted.</h2>
                    <p class="lead">Themesberg is an experienced and passionate group of designers, developers, project managers, writers and artists. Every client we work with becomes a part of the team. Together we face the challenges and celebrate the victories.</p>
                    <p class="lead">With a culture of collaboration, a roster of talent, and several office pooches, the Themesberg team is active in the creative community, endlessly interested in what’s next, and generally pleasant to be around.</p>
                    <img src="../../assets/img/signature.svg" alt="signature" class="mt-4" width="150">
                </div>
            </div>
        </div>
    </section>
    <!-- End of section -->
    <!-- Section -->
    <section class="section section-lg pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 text-center">
                    <!-- Visit Box -->
                    <div class="icon-box mb-4">
                        <div class="icon icon-primary mb-4">
                            <span class="fas fa-user"></span>
                        </div>
                        <h3 class="h5">Team Members</h3>
                        <span class="counter display-3 text-gray d-block">500</span>
                    </div>
                    <!-- End of Visit Box -->
                </div>
                <div class="col-md-4 col-lg-4 text-center">
                    <!-- Call Box -->
                    <div class="icon-box mb-4">
                        <div class="icon icon-primary mb-4">
                            <span class="fas fa-money-check"></span>
                        </div>
                        <h3 class="h5">Projects Published</h3>
                        <span class="counter display-3 text-gray d-block">2400</span>
                    </div>
                    <!-- End of Call Box -->
                </div>
                <div class="col-md-4 col-lg-4 text-center">
                    <!-- Email Box -->
                    <div class="icon-box mb-4">
                        <div class="icon icon-primary mb-4">
                            <span class="fas fa-globe-europe"></span>
                        </div>
                        <h3 class="h5">Countries</h3>
                        <span class="counter display-3 text-gray d-block">80</span>
                    </div>
                    <!-- End of Email Box -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of section -->
    <!-- Section -->
    <section class="section section-lg bg-gray-200">
        <figure class="position-absolute top-0 left-0 w-100 d-none d-md-block mt-n3">
            <svg class="fill-gray-200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 43.4" style="enable-background:new 0 0 1920 43.4;" xml:space="preserve">
               <path d="M0,23.3c0,0,405.1-43.5,697.6,0c316.5,1.5,108.9-2.6,480.4-14.1c0,0,139-12.2,458.7,14.3 c0,0,67.8,19.2,283.3-22.7v35.1H0V23.3z"></path>
            </svg>
         </figure>
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <h2 class="h1 fw-light"><span class="fw-bold">Our</span> history</h2>
                </div>
            </div>
            <div class="row justify-content-center mt-6">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-8">
                        <div class="timeline timeline-one dark px-3 px-sm-0">
                            <!-- Timeline Item 1 -->
                            <div class="timeline-item">
                                <h3 class="h4 mb-4">Present</h3>
                                <p>Now over seven years old, Bootstrap is an established and widely-used HTML, CSS, and JavaScript framework. It can be used as a basis for creating responsive web and mobile sites and web applications.</p>
                            </div>
                            <!-- Timeline Item 2 -->
                            <div class="timeline-item">
                                <h3 class="h4 mb-4">Our first products</h3>
                                <div class="my-3">
                                    <span class="icon icon-sm icon-purple me-2"><span class="fab fa-bootstrap"></span></span>
                                    <span class="icon icon-sm icon-info me-2"><span class="fab fa-react"></span></span>
                                    <span class="icon icon-sm icon-success me-2"><span class="fab fa-vuejs"></span></span>
                                    <span class="icon icon-sm icon-danger"><span class="fab fa-angular"></span></span>
                                </div>
                                <p>Bootstrap. Build responsive, mobile-first projects on the web with the world's most popular front-end component library. Bootstrap is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your
                                    ideas.
                                </p>
                            </div>
                            <!-- Timeline Item 3 -->
                            <div class="timeline-item">
                                <h3 class="h4 mb-4">Our office</h3>
                                <img class="mt-2" src="../../assets/img/office.png" alt="Themesberg workspace" width="300">
                                <p>AngularJS is a JavaScript-based open-source front-end web application framework mainly maintained by Google and by a community of individuals and corporations to address many of the challenges encountered in developing
                                    single-page applications.
                                </p>
                            </div>
                            <!-- Timeline Item 4 -->
                            <div class="timeline-item">
                                <h3 class="h4 mb-4">An ideea becomes a business</h3>
                                <p>AngularJS is a JavaScript-based open-source front-end web application framework mainly maintained by Google and by a community of individuals and corporations to address many of the challenges encountered in developing
                                    single-page applications.
                                </p>
                                <img class="mt-2" src="../../assets/img/signature.svg" alt="signature" width="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <figure class="position-absolute bottom-0 left-0 w-100 d-none d-md-block mb-n2">
            <svg class="fill-white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 43.4" style="enable-background:new 0 0 1920 43.4;" xml:space="preserve">
               <path d="M0,23.3c0,0,405.1-43.5,697.6,0c316.5,1.5,108.9-2.6,480.4-14.1c0,0,139-12.2,458.7,14.3 c0,0,67.8,19.2,283.3-22.7v35.1H0V23.3z"></path>
            </svg>
         </figure>
    </section>
    <!-- Section -->
    <section class="section section-lg">
        <div class="container">
            <div class="row mb-5 mb-lg-6">
                <div class="col-12 col-md-9 col-lg-8 text-center mx-auto">
                    <h2 class="h1 mb-4">Funny &amp; Creative Team</h2>
                    <p class="lead">We have developed a multi-discipline portfolio as a digital marketing agency, we also have roots in print media and even photography.
                    </p>
                </div>
            </div>
            <div class="row mb-5 mb-lg-6">
                <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="card shadow border-gray-300">
                        <img src="../../assets/img/team/profile-picture-1.jpg" class="card-img-top rounded-top" alt="Joseph Portrait">
                        <div class="card-body">
                            <h3 class="h4 card-title mb-2">Joseph Garth</h3>
                            <span class="card-subtitle text-gray fw-normal">Co-Founder</span>
                            <p class="card-text my-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <ul class="list-unstyled d-flex mt-3 mb-0">
                                <li>
                                    <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                        <span class="fab fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                        <span class="fab fa-slack-hash"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="dribbble social link" class="icon-dribbble me-3">
                                        <span class="fab fa-dribbble"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="card shadow border-gray-300">
                        <img src="../../assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-top" alt="Bonnie portrait">
                        <div class="card-body">
                            <h3 class="h4 card-title mb-2">Bonnie Green</h3>
                            <span class="card-subtitle text-gray fw-normal">Web Developer</span>
                            <p class="card-text my-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <ul class="list-unstyled d-flex mt-3 mb-0">
                                <li>
                                    <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                        <span class="fab fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                        <span class="fab fa-slack-hash"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="dribbble social link" class="icon-dribbble me-3">
                                        <span class="fab fa-dribbble"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-gray-300">
                        <img src="../../assets/img/team/profile-picture-4.jpg" class="card-img-top rounded-top" alt="Jose Avatar">
                        <div class="card-body">
                            <h3 class="h4 card-title mb-2">Jose Leos</h3>
                            <span class="card-subtitle text-gray fw-normal">Web publications designer</span>
                            <p class="card-text my-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <ul class="list-unstyled d-flex mt-3 mb-0">
                                <li>
                                    <a href="#" target="_blank" aria-label="facebook social link" class="icon-facebook me-3">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="twitter social link" class="icon-twitter me-3">
                                        <span class="fab fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="slack social link" class="icon-slack me-3">
                                        <span class="fab fa-slack-hash"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" aria-label="dribbble social link" class="icon-dribbble me-3">
                                        <span class="fab fa-dribbble"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <!-- Contact Card -->
                    <div class="card border-0 p-2 p-md-3 p-lg-5">
                        <div class="card-header bg-white border-0 text-center">
                            <h2>Want to work with us?</h2>
                            <p>Cool! Let’s talk about your project</p>
                        </div>
                        <div class="card-body pt-0">
                            <form action="#">
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="name">Your Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3"><span class="fas fa-user-circle"></span></span>
                                        <input type="text" class="form-control" placeholder="e.g. Bonnie Green" id="name" required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="email">Your Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4"><span class="fas fa-envelope"></span></span>
                                        <input type="email" class="form-control" placeholder="example@company.com" id="email" required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="mb-4">
                                    <label for="message">Your Message</label>
                                    <textarea placeholder="Your message" class="form-control" id="message" rows="4" required></textarea>
                                </div>
                                <!-- End of Form -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-secondary">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End of Contact Card -->
                </div>
            </div>
        </div>
    </section>
    <!-- End of section -->
@endsection
