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
<form action="{{ route('history.update',$history->id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}


 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Fund:</strong>
				<select name="box_id" class="browser-default custom-select">
				 <option value="{{ $history->box_id }}"></option>
			@foreach($box as $b)
			 <option value="{{ $b->id }}">{{ $b->name}}</option>
			@endforeach
		</select>
		</div>
</div>

 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Method:</strong>
				<select name="method" class="browser-default custom-select">
				 <option value="{{ $history->method }}"></option>

			 <option value="check">check</option>
	 <option value="cache">Cash</option>
	  <option value="transfer">transfer</option>
		</select>
		</div>
</div>

 <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" name="amount" class="form-control" value="{{$history->amount}}"  id="name"  placeholder="Enter  amount" >
  </div>
 <div class="form-group">
    <label for="tax">With Tax:</label>
    <input type="checkbox" name="tax"  value="{{$history->tax}}"   >
  </div>
 <div class="form-group">
    <label for="tax">With Declared:</label>
    <input type="checkbox" name="declared"  value="{{$history->declared}}"   >
  </div>
  	<div class="form-group">
		   <h2>Time:</h2>
	<input type="datetime-local" style="width:40%;hight:30%;" name="time" value="{{str_replace(' ','T',$history->time)}}">
  </div>
  <div class="form-group">
		   <h2>Image:</h2>
     <input type="file" name="image" class="form-control">
   </div>
   <div class="form-group">
    <label for="amount">Note</label>
    <input type="text" name="note" class="form-control" value="{{$history->note}}"  id="name"  placeholder="Enter  note" >
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
