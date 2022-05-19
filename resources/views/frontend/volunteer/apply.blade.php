@extends('layouts.frontend')
@section('meta')
<title>
    {{ config('app.name') }} | Donate Transparently
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection
@section('css')
<style>
    .navbar-main {
        background-color: #1F2937 !important;
    }
</style>
@endsection
@section('js')
@endsection
<section class="section section-lg pt-6">
  <div class="container">
    <div class="row justify-content-center mb-5 mb-lg-6">
      <div class="col-12 col-lg-8">
        <div class="card border-0 p-2 p-md-3 p-lg-5">
          <div class="card-header bg-white border-0 text-center">
            <h2>Want to work with us?</h2>
            <p>Cool! Let's talk about you</p>
          </div>
          <div class="card-body px-0 pt-0">
            <form action="{{ route('frontend.volunteer.submit')}}" method="POST">
                @csrf
              <div class="mb-4">
                <label for="name">Your Name</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">
                    <span class="fas fa-user-circle"> </span>
                  </span>
                  <input
                  name="name"
                    type="text"
                    class="form-control"
                    placeholder="e.g. Bonnie Green"
                    id="name"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="age">Your Age</label>
                <div class="input-group">
                  <input
                  name="age"
                    type="number"
                    class="form-control"
                    id="age"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="email">Your Email</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon4">
                    <span class="fas fa-envelope"> </span>
                  </span>
                  <input
                  name="email"
                    type="email"
                    class="form-control"
                    placeholder="example@company.com"
                    id="email"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="number">Contact Number</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">
                    <span class="fas fa-phone"> </span>
                  </span>
                  <input
                  name="number"
                    type="number"
                    class="form-control"
                    placeholder="e.g. Bonnie Green"
                    id="number"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="organization">Organization</label>
                <div class="input-group">
                  <input
                  name="organization"
                    type="text"
                    class="form-control"
                    placeholder="e.g. Roshini Foundations"
                    id="organization"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="state">State Name</label>
                <div class="input-group">
                  <input
                  name="state"
                    type="text"
                    class="form-control"
                    placeholder="e.g. Tamil Nadu"
                    id="state"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="city">City Name</label>
                <div class="input-group">
                  <input
                  name="city"
                    type="text"
                    class="form-control"
                    placeholder="e.g. Chennai"
                    id="city"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="address">Your Address</label>
                <textarea
                name="address"
                  placeholder="Your address"
                  class="form-control"
                  id="address"
                  rows="4"
                  required=""
                ></textarea>
              </div>
              <div class="mb-4">
                <label for="Pincode">Pincode</label>
                <div class="input-group">
                  <input
                  name="pincode"
                    type="number"
                    class="form-control"
                    placeholder="e.g. 600045"
                    id="Pincode"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="experience">Tell Us about your previous NGO experience</label>
                <textarea
                name="experience"
                  placeholder="Your message"
                  class="form-control"
                  id="experience"
                  rows="4"
                  required=""
                ></textarea>
              </div>
              <div class="mb-4">
                <label for="Education">Your Education Qualification</label>
                <div class="input-group">
                  <input
                  name="education"
                    type="text"
                    class="form-control"
                    id="Education"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="Profession">Your Current Profession</label>
                <div class="input-group">
                  <input
                  name="profession"
                    type="text"
                    class="form-control"
                    id="Profession"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="reason">Why you want to join Roshni Moolchandani Charitable Trust?</label>
                <textarea
                name="reason"
                  placeholder="Your message"
                  class="form-control"
                  id="reason"
                  rows="4"
                  required=""
                ></textarea>
              </div>
              <div class="mb-4">
                <label for="Facebook">Facebook Profile Link</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">
                    <span class="fas fa-user-circle"> </span>
                  </span>
                  <input
                  name="facebook"
                    type="text"
                    class="form-control"
                    id="Facebook"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="Instagram">Instagram Profile Link</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">
                    <span class="fas fa-user-circle"> </span>
                  </span>
                  <input
                  name="instagram"
                    type="text"
                    class="form-control"
                    id="Instagram"
                    required=""
                  />
                </div>
              </div>
              <div class="mb-4">
                <label for="twitter">Twitter Profile Link</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3">
                    <span class="fas fa-user-circle"> </span>
                  </span>
                  <input
                  name="twitter"
                    type="text"
                    class="form-control"
                    id="twitter"
                    required=""
                  />
                </div>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn rounded btn-secondary">
                  Proceed
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
