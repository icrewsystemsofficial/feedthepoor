@component('mail::message')
# Hey there,

#feedThePoor has received a new testimonial from <b>{{ $testimonial->name }}</b> with the following details!

Email: {{ $testimonial->email }}
Name: {{ $testimonial->name }}
Message: 
{{ $testimonial->message }}

@component('mail::button', ['url' => url('/admin/testimonials#id'.$testimonial->id), 'color' => 'primary'])
Admin Panel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent