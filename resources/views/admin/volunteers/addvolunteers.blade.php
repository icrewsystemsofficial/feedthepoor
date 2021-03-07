@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style> 
  
  </style>
</head>
<body>
<div class="container">
<div class ="jumbotron">
<h1>Add Volunteer's Details </h1>
<br>
<br>
<form action="{{ route('addimage')}}" method='POST' enctype= 'multipart/form-data'>
{{csrf_field()}}
<div class="form-group">
<label> Volunteer's Full Name </label>
<input type= "text" name="name" class= "form-control" placeholder = "Enter Volunteer's Full Name">
</div>

<div class="form-group">
<label>Volunteer's Location</label>
<input type= "text" name="location" class= "form-control" placeholder = "Enter Volunteer's Location">
</div>

<div class="form-group">
<label>Description</label>
<input type= "text" name="desc" class= "form-control" placeholder = "Enter Volunteer's Description">
</div>

<div class="form-group">
<label>Volunteer's Facebook Link</label>
<input type= "text" name="facebook" class= "form-control" placeholder = "Enter Volunteer's Facebook Link">
</div>

<div class="form-group">
<label>Volunteer's Instagram Link</label>
<input type= "text" name="instagram" class= "form-control" placeholder = "Enter Volunteer's Instagram Link">
</div>


<div class="form-group">
<label>Volunteer's LinkedIn Link</label>
<input type= "text" name="linkedin" class= "form-control" placeholder = "Enter Volunteer's LinedIn Link">
</div>

<label>Add Volunteer's Image </label>
<div class="input-group">

<div class = "custom-file">

<input type= "file" name="image" class= "custom-file-input">
<label class= "custom-file-label">Upload Volunteer's Image </label>
</div>
</div>
<br>
<button type="submit" name ="submit" class= "btn btn-primary">  Save Data  </button>
<a href="addvolunteersform" class="btn btn-primary"> Done </a> 

</form>
</div>
</div>


</body>
</html>

@endsection('content')
