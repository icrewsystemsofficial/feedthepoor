@component('mail::PDFLayout')
{{-- Header --}}
@slot('header')
{{ config('app.name') }}
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
