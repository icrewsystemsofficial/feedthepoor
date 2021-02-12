<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin | Upload </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
        /* background-color: #0093E9;
        background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%); */
        body{
            background: #0093E9;
        }
        .card{
            box-shadow: 5px 5px 30px rgb(63, 63, 63);
        }
        .chooseFile{
            position: relative;
            outline: none;
            cursor: pointer;
        }
        .chooseFile::before{
            content: 'Choose File';
            position: absolute;
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
            border: none;
            color: white;
            padding: 5px 10px;
        }
        .uploadFile{
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
            border: none;
            color: white;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<div class="container pt-5">
<a href="{{asset('admin/donations')}}" class="btn btn-danger mb-2">Back</a>

<div class="p-4 w-100 p bd-highlight alert alert-success text-center"> {!! \Session::get('success') !!}</div>
    <div class="card">
    
    
<div class="card-body">
<form action="{{ asset('admin/upload')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="image" class="card-title p-5 pr-4 chooseFile" ></input>

<input type="submit" style="float:right;" value="Upload" class="uploadFile" />
</form>

</div>
</div>
</div>   
</body>

</html>



