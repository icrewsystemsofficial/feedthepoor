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
<h1>Add Volunteers </h1> <br>
<a href="addvolunteers" class="btn btn-primary"> Add a Volunteer </a> <br> <br>
<table class="table table-stripped table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Full Name</th>
      <th scope="col">Location</th>
      <th scope="col">Description</th>
      <th scope="col">Display Picture</th>
     <!-- <th>EDIT </th> -->
      <th>DELETE</th>
    </tr>
  </thead>
  <tbody>

  @foreach ($addvolunteersform as $addvolunteers)
  

  
    <tr>
      <th>{{$addvolunteers->id}}</th>
      <th>{{$addvolunteers->name}}</th>
      <th>{{$addvolunteers->location}}</th>
      <th>{{$addvolunteers->desc}}</th>
      <th><img src="{{url('uploads/addvolunteers/' . $addvolunteers->image)  }}" alt="image" width="100px" height="100px"></th>
      <!-- <th> <a href="editform/{{$addvolunteers->id}}" class= "btn btn-success"> EDIT </a> </th>  -->
      <th> <a href="deleteform/{{$addvolunteers->id}}" class= "btn btn-danger"> Delete </a> </th>
     
    </tr>
    @endforeach
  </tbody>
</table>

</div>
</div>


</body>
</html>

@endsection('content')
