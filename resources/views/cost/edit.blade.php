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
<form action="{{ route('cost.update',$cost->id) }}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}
  
  <div class="row" style="margin-top:1%;" hidden>
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Type:</strong>
				<select name="type_id" class="browser-default custom-select">
				 <option value="{{$cost->type_id}}"></option>
				
		
			 <option value="{{ $type_id }}">{{ $type_id}}</option>
			
		</select>
		
</div>
</div>
 
   <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control" value="{{$cost->name}}" id="name"  placeholder="Enter  Name" >
  </div>

 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Parent:</strong>
				<select name="parent_id" class="browser-default custom-select">
					 <option value="{{$cost->parent_id}}"></option>
			@foreach($costs as $c)
			 <option value="{{ $c->id }}">{{ $c->name}}</option>
			@endforeach
		</select>
		
</div>
</div>

</br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection