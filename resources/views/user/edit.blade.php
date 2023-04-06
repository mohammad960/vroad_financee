@extends('welcome')
@section('content')
<body>
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
<form action="{{ route('user.update',$user->id) }}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}
  <div class="form-group">
    <label for="firstname">User Name</label>
    <input type="text" name="username"  value="{{$user->username}}" class="form-control" id="name"  placeholder="Enter  Name" >
  </div>
  <div class="form-group">
    <label for="duration">Store</label>
    <select name="market_id">
	@foreach ($markets  as $t)
	<option value="{{ $t->id}}">{{$t->name }}</option>
	@endforeach
	</select>
  </div>
     <div class="form-group">
    <label for="address">Password</label>
    <input type="password" name="password" class="form-control"  id="address"  placeholder="Enter Password" >
  </div>
  

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
@endsection