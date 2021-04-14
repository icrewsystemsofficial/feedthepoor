@component('mail::message')
# Hey {{$data->name}},
Thanks for contacting us!
We've received your message.

@component('mail::panel')
    {{$data->message}}
@endcomponent

Kindly find the response below.
@component('mail::panel')
    {{$data->reply}}
@endcomponent

For any queries, please feel free to write back to us.

Regards,<br>
Team {{ config('app.name') }}
@endcomponent
