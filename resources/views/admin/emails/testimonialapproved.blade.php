@component('mail::message')
# Hey {{$testimonial->name}},

We sincerely thank you for your testimonial.
We've successfully received your valuable thoughts and have published it on our site! Thank you for your continued support!

@component('mail::button', ['url' => url('/testimonials/view/'.$testimonial->hashed_id), 'color' => 'primary'])
View Testimonial
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent