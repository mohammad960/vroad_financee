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
<div Style="background-color:white;border-top:solid 3px white;padding:2%;">
<form action="{{ route('good.update',$good->id) }}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}
 <div class="form-group">
    <label for="time">Time:</label>
  <input type="datetime-local" style="width:40%;hight:30%;" name="time" value="{{str_replace(' ','T',$good->time)}}"  value="2017-06-01T08:30" placeholder="Enter Time......." value="" required>
  </div>

    <div class="form-group">
    <label for="amount">Amount</label>
   	<input type="text" style="width:40%;hight:30%;" name="amount" value="{{$good->amount}}" placeholder="Enter amount......." value="" required>
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
 </div>
@endsection