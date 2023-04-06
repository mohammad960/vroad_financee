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
<form action="{{ route('type_cost.store') }}" method="POST" enctype="multipart/form-data">


 {{ csrf_field() }}
 
  <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control"  id="name"  placeholder="Enter  Name" >
  </div>
  <div class="form-group">
    <label for="amount">Start Amount</label>
    <input type="text" name="start_amount" class="form-control"   id="start_amount"  placeholder="Enter  start_amount" >
  </div>

 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Market:</strong>
				<select name="market_id" class="browser-default custom-select">
				
			@foreach($markets as $market)
			 <option value="{{ $market->id }}">{{ $market->name}}</option>
			@endforeach
		</select>
		
</div>
</div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection