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
<form action="{{ route('market.store') }}" method="POST" enctype="multipart/form-data">


 {{ csrf_field() }}
   <div class="form-group">
    <label for="firstname">Name</label>
    <input type="text" name="name" class="form-control"  id="name"  placeholder="Enter  Name" >
  </div>
 <div class="form-group">
    <label for="number">Number</label>
    <input type="number" name="number" class="form-control"   id="name"  placeholder="Enter  Number" >
  </div>
 <div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" class="form-control"   id="name"  placeholder="Enter  Address" >
  </div>
 <div class="form-group">
    <label for="owner_name">Partner Ship</label>
    <input type="text" name="owner_name" class="form-control"   id="name"  placeholder="Enter  owner_name" >
  </div>


</br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
@endsection