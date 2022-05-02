<x-guest-layout>
    <x-auth-card>
        <main>
            <!-- Section -->
            <style>
                .hero-header {
                    min-height: 50vh;
                    background: #000 url(https://i.imgur.com/5KfRXY1.png) center center no-repeat;
                    background-size: cover;
                    position: relative;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    box-shadow: 0 0 200px rgba(0, 0, 0, 0.9) inset;
                }
            </style>
            <section class="min-vh-100 d-flex align-items-center section-image overlay-soft-dark bg-primary hero-header">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="signin-inner my-4 my-lg-0 bg-white shadow-soft border rounded border-gray-300 p-4 p-lg-5 w-100 fmxw-500">
                                <div class="text-center text-md-center mb-4 mt-md-0">
                                    <h1 class="mb-0 h3">
                                        Login to {{ config('app.name') }}
                                    </h1>
                                </div>

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

                                <form id="loginForm" method="POST" action="{{ route('login') }}" class="mt-4">
                                    @csrf
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="email">Your Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><span class="fas fa-envelope"></span></span>
                                            <x-input id="email" type="email" name="email" :value="old('email')" required autofocus class="form-control" placeholder="john.doe@ngo.com" />
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="form-group">
                                        <!-- Form -->
                                        <div class="form-group mb-4">
                                            <label for="password">Your Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon2"><span class="fas fa-unlock-alt"></span></span>
                                                <x-input id="password" placeholder="Password" type="password" name="password" required autocomplete="current-password" class="form-control" />
                                            </div>
                                        </div>
                                        <!-- End of Form -->
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check mb-0">
                                                <input id="remember_me" type="checkbox" class="form-check-input" type="checkbox" value="" name="remember">
                                                <label for="remember_me" class="form-check-label mb-0" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                            <div>
                                                @if (Route::has('password.request'))
                                                <a class="small text-right" href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <x-loadingbutton @click="submitForm" type="submit" class="btn btn-primary">
                                            Login
                                        </x-loadingbutton>
                                    </div>
                                </form>
                                <!-- <div class="mt-3 mb-4 text-center">
                                <span class="fw-normal">or login with</span>
                            </div>
                            <div class="btn-wrapper my-4 text-center">
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-300 text-facebook me-2" aria-label="facebook button" title="facebook button">
                                    <span aria-hidden="true" class="fab fa-facebook-f"></span>
                                </a>
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-300 text-twitter me-2" aria-label="twitter button" title="twitter button">
                                    <span aria-hidden="true" class="fab fa-twitter"></span>
                                </a>
                                <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-300 text-facebook" aria-label="github button" title="github button">
                                    <span aria-hidden="true" class="fab fa-github"></span>
                                </a>
                            </div> -->
                                <div class="d-flex justify-content-center align-items-center mt-4">
                                    <span class="fw-normal">
                                        &copy; {{ config('app.name') }} - {{ config('app.ngo_name') }}
                                        <br>
                                        <span class="text-center">
                                            Made with <i class="fas fa-heart text-danger"></i> by icrewsystems
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            submitForm(e) {
                e.preventDefault();
                setTimeout(() => {
                    document.getElementById('loginForm').submit();
                }, 2000);
            }
        </script>
    </x-auth-card>
</x-guest-layout>
