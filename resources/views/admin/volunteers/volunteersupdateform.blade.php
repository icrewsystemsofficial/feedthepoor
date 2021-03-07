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
<h1> Edit Image </h1>

<form action="/updateform/{{ $addvolunteersform->id}}" method='POST' enctype= 'multipart/form-data'>
{{ csrf_field() }}
{{method_field('PUT')}}


<input type="hidden" name="id" id="id" value="{{ $addvolunteersform -> id }}">
<div class="form-group">
<label> Volunteer's Full Name </label>
<input type= "text" name="name" value = "{{$addvolunteersform->name}}" class= "form-control" placeholder = "Enter Volunteer's Full Name">
</div>

<div class="form-group">
<label>Volunteer's Location</label>
<input type= "text" name="location" value = "{{$addvolunteersform->location}}"  class= "form-control" placeholder = "Enter volunteer's location">
</div>
<label>Add Volunteer's Image </label>
<div class="input-group">

<div class = "custom-file">

<input type= "file" name="image" class= "custom-file-input"  value = "{{$addvolunteersform->image}}" >
<label class= "custom-file-label">Upload Image </label>
</div>
</div>
<br>
<button type="submit" name ="submit" class= "btn btn-primary">  Update </button>
</form>
</div>
</div>


</body>
</html>

@endsection('content')
