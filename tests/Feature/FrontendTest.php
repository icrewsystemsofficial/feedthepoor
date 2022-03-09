<?php


use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('loads landing page correctly', function () {
    $response = $this->get(route('frontend.index'));

    $response->assertStatus(200);
});
it('loads donate page correctly', function () {
    $response = $this->get(route('frontend.donate'));

    $response->assertStatus(200);
});
it('loads donation process correctly', function () {
    $response = $this->get(route('frontend.donate.process'));

    $response->assertStatus(302);
});
it('loads activity page correctly', function () {
    $response = $this->get(route('frontend.activity'));

    $response->assertStatus(200);
});
it('loads campaigns page correctly', function () {
    $response = $this->get(route('frontend.campaigns'));

    $response->assertStatus(200);
});
it('loads transparency report page correctly', function () {
    $response = $this->get(route('frontend.transparency-report'));

    $response->assertStatus(200);
});
it('loads thank you page correctly', function () {
    $response = $this->get(route('frontend.donate.thank_you'));

    $response->assertStatus(302);
});
it('loads track donation page correctly', function () {
    $response = $this->get(route('frontend.track-donation'));

    $response->assertStatus(200);
});



it('loads about page correctly', function () {
    $response = $this->get(route('frontend.about'));

    $response->assertStatus(200);
});
it('loads volunteer page correctly', function () {
    $response = $this->get(route('frontend.volunteer'));

    $response->assertStatus(200);
});
it('loads faq page correctly', function () {
    $response = $this->get(route('frontend.faq'));

    $response->assertStatus(200);
});
it('loads contact page correctly', function () {
    $response = $this->get(route('frontend.contact'));

    $response->assertStatus(200);
});