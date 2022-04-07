@component('mail::message')
# Hey {{ $user->name }},
We cordially welcome you to the family of {{ config('app.ngo_name') }}, where we work to bring smiles to the underprivileged.
<br><br>
Your dedicated relationship manager is Ms. Neha (+91 95831 86287). Please contact her in regards to any queries you have
with your donation.
<br><br>
Every second you spend with us matters and so does the penny that you donate. Our motto is to eradicate hunger and you can be our envoy.
<br><br>
So think no more and click the button below to become a reason someone sleeps with a smile.
@component('mail::button', ['url' => route('frontend.donate')])Donate Now @endcomponent
<br><br>

Regards,<br>
Operations Team,<br>
{{ config('app.ngo_name') }}
@endcomponent
