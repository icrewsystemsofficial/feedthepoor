<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin | Upload </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<a href="{{asset('admin/donations')}}" class="btn btn-danger">Back</a>
<div class="container pt-5">
    <div class="card">
    <div class="card-title p-5"> upload your photos</div>
<div class="card-body">
<form action="{{ asset('admin/upload')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="image" />
<input type="submit" style="float:right;" value="Upload" />
</form>

</div>
</div>
</div>   
</body>

</html>



