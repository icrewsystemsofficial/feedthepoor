@component('mail::message')
# Hey {{ $details['name'] }}

Congratulations 🎉 <br>
<p>You have been selected to join our NGO and work with us, our team will be contacting you soon regarding this and will be explaining your work.</p>
<br>
So for now you can login in to the dashboard,check it out by clicking the below button

@component('mail::panel')
Dashboard credentials
    <ul>
        <li>Email Id : {{ $details['email'] }}</li>
        <li>Password: {{ $details['password'] }}</li>
    </ul>
@endcomponent

@component('mail::button', ['url' => route('admin.dashboard') , 'color' => 'success'])
    Dashboard
@endcomponent

Regards,<br>
Team {{ config('app.name') }}
@endcomponent
