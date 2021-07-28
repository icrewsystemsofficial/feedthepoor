<!DOCTYPE html>
<html lang="en">
<head>
    @yield('meta')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('css')

</head>
<body>
    @yield('content')
    @yield('js')
</body>
</html>