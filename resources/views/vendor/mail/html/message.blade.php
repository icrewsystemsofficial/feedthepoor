@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }}. Made with love by <a href="https://icrewsystems.com/en?ref={{ env('APP_NAME') }}mail">icrewsystems</a> LLP. 
<br />
@lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
