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
<form action="{{ route('archive.store') }}" method="POST" enctype="multipart/form-data">
 {{ csrf_field() }}
          <div class="col-xs-12 col-sm-12 col-md-12">
			 <strong>Select :</strong>
				<select  id="choices-multiple-remove-button"  class="browser-default custom-select"  name="type_name[]" multiple>
				<option value="all">All</option>
				<option value="histories">Income and Expense</option>
				<option value="salaries">Salary</option>
				<option value="goods">goods</option>
				<option value="debits">Debits</option>
				
				
		</select>
		</div>
		</br>
  <div class="form-group">
    <label for="firstname">Period Start</label>
	<input type="datetime-local" style="width:40%;hight:30%;" name="time_start" placeholder="Enter Time......." value="" required>
  </div>
<div class="form-group">
    <label for="firstname">Period End</label>
	<input type="datetime-local" style="width:40%;hight:30%;" name="time_end" placeholder="Enter Time......." value="" required>
  </div>

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