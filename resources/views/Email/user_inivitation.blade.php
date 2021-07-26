@component('mail::message')
# Hey {{ $tempuser->name }},
An account has been created for you on our admin page.Kindly use inivitation link to Register. 

@component('mail::panel')
Name:{{ $tempuser->name }}
Email:{{ $tempuser->email }}
<a href='http://127.0.0.1:8000/inivitation/{{ $tempuser->unique_code }}'>http://127.0.0.1:8000/inivitation/{{ $tempuser->name }}</a>
@endcomponent
@component('mail::button', ['url' => 'http://127.0.0.1:8000/user-inivitation/{{ $tempuser->unique_code }}', 'color' => 'success'])
Accept Invitation
@endcomponent

For any queries, please feel free to write  to us.

Regards,<br>
Team {{ config('app.name') }}
@endcomponent