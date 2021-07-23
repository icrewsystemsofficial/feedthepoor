<!DOCTYPE html>
<html>
<head>
    <title>inivitation for registeration in feed the poor  </title>
</head>
<body>
    <h1>Hello {{ $tempuser->name }}</h1>
    <h2>Please click the below link for registration for the role {{ $tempuser->role }}<a href='http://127.0.0.1:8000/user-inivitation/{{ $tempuser->unique_code }}'>
        http://127.0.0.1:8000/inivitation//{{ $tempuser->name }}</a> </h2>    

   
    <p>Thank you</p>
</body>
</html>