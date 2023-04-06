@extends('adminlte::page')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('role.store') }}" method="POST">
    {{ csrf_field() }}
  <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control" id="name"  placeholder="Enter  Name" >
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection