@extends('welcome')

@section('content')
 <style>
          h2 {
               color: black;
               font-size: 30px;
               
          }
		  .button-header{
			  float:right;
			  color:black;
			  margin-top:-5%;
			  background-color:white;
			  
		  }
		  .export-button{
			  visibility: hidden;
			  
		  }
		  div.dt-buttons {
			 float:right;
			  
		  }
		 .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
				background-color: #71DCFD;
				color: #white;
			}
		.navbar-dark .navbar-nav .nav-link:hover {
			  color: #71DCFD;
			}
			[class*=sidebar-dark-] {
				background-color: black;
				background: url(../../img/login_bg.png);
			}
			[class*=sidebar-dark] .brand-link {
    border-bottom: 1px solid #71DCFD;
    color: #71DCFD;
}
     </style>
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
<div Style="background-color:white;border-top:solid 3px white;padding:2%;">
<form action="{{ route('box.update',$box->id) }}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}
  <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control" value="{{$box->name}}"  id="name"  placeholder="Enter  Name" >
  </div>
 <div class="form-group">
    <label for="number">Number</label>
    <input type="number" name="number" class="form-control" value="{{$box->number}}"  id="name"  placeholder="Enter  Number" >
  </div>
 <div class="form-group">
    <label for="type">Type</label>
    <input type="text" name="type" class="form-control"  value="{{$box->type}}"   id="type"  placeholder="Enter  Type" >
  </div>

 <div class="form-group">
       <label for="amount">Starting Balance</label>
    <input type="text" name="amount" class="form-control"   value="{{$box->amount}}"  id="amount"  placeholder="Enter  amount" >
  </div>
 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select Store:</strong>
				<select name="market_id" class="browser-default custom-select">
				 <option value="{{ $box->market_id }}"></option>
			@foreach($markets as $market)
			 <option value="{{ $market->id }}">{{ $market->name}}</option>
			@endforeach
		</select>
		
</div>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection