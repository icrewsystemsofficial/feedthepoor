<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class="m-auto w-50 text-dark p-4">
    @component('mail::message')
        <h1 class="text-dark fs-2"> Hey admin,</h1>
        <p class="text-dark fs-3 fw-bolder">We have new email from {{ $details['email'] }} </p>
        <p class="text-secondary fs-3 fw-bolder">This message is send by {{ $details['name'] }}  </p>
        <p class="text-secondary fs-3 fw-bolder"> The query : {{ $details['message'] }}</p>
        <p class="text-danger fs-5 fw-bolder"> Lets start the process !!!</p>

    @endcomponent
    </div>


</body>

</html>
