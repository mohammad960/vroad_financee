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
 <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

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
<form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">


 {{ csrf_field() }}
   <div class="form-group">
    <label for="firstname">TEXT</label>
    <input type="text" name="text" class="form-control"  id="text"  placeholder="Enter  text" >
  </div>

@if(Auth::user()->role_id==1)
 <div class="row" style="margin-top:1%;">
             <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select User:</strong>
				<select  id="choices-multiple-remove-button"  class="browser-default custom-select"  name="user_id[]" style="float:right;" multiple>
					
					@foreach($users as $user)
					 <option value="{{ $user->id }}">{{ $user->username}}</option>
					@endforeach
		</select>
		</div>

</div> 
@endif
</br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script>
$(document).ready(function(){

var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
removeItemButton: true,
maxItemCount:1000,
searchResultLimit:100,
renderChoiceLimit:100
});
});

</script>
@endsection