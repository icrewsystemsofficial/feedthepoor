<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html>

<head>
    <title>inivitation for registeration in feed the poor </title>
</head>

<body>
    <h1>Hello {{ $tempuser->name }}</h1>
    <h2>Please click the below link for registration for the role {{ $tempuser->role }}<a
            href='http://127.0.0.1:8000/user-inivitation/{{ $tempuser->unique_code }}'>
            http://127.0.0.1:8000/user-inivitation/{{ $tempuser->unique_code }}</a> </h2>


    <p>Thank you</p>
</body>

</html>
>>>>>>> 7f8b60d45da30a9a87881c3db8939aef38661111
