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
<form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">


 {{ csrf_field() }}


   <div class="form-group">
    <label for="firstname">Full Name</label>
    <input type="text" name="full_name" class="form-control"  id="full_name"  placeholder="Enter  full_name" >
  </div>
   <div class="form-group">
    <label for="firstname">Number</label>
    <input type="number" name="number" class="form-control"  id="number"  placeholder="Enter  number" >
  </div>
     <div class="form-group">
    <label for="firstname">Phone</label>
    <input type="text" name="phone" class="form-control"  id="phone"  placeholder="Enter  phone" >
  </div>
     <div class="form-group">
    <label for="firstname">Price Hour</label>
    <input type="text" name="price_hour" class="form-control"  id="price_hour"  placeholder="Enter  price_hour" >
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
</br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
