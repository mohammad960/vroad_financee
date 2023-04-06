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
<form action="{{ route('cost.store') }}" method="POST" enctype="multipart/form-data">


 {{ csrf_field() }}
  <div class="row" style="margin-top:1%;" hidden>
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Type:</strong>
				<select name="type_id" class="browser-default custom-select">
				
			
			 <option value="{{ $type_id }}">{{ $type_id}}</option>
		
		</select>
		
</div>
</div>
 
   <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control"  id="name"  placeholder="Enter  Name" >
  </div>

 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Parent:</strong>
				<select name="parent_id" class="browser-default custom-select">
				 <option value=""></option>
			@foreach($costs as $cost)
			 <option value="{{ $cost->id }}">{{ $cost->name}}</option>
			@endforeach
		</select>
		
</div>
</div>

</br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection