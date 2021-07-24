@component('mail::message')
# Hey {{ $tempuser->name }},


@component('mail::panel')
<h2>Please click the below link for registration for the role {{ $tempuser->role }}<a href='http://127.0.0.1:8000/user-inivitation/{{ $tempuser->unique_code }}'>
        http://127.0.0.1:8000/inivitation//{{ $tempuser->name }}</a> </h2>
@endcomponent


For any queries, please feel free to write back to us.

Regards,<br>
Team {{ config('app.name') }}
@endcomponent