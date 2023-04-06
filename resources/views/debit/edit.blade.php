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
<form action="{{ route('debit.update',$debit->id) }}" method="POST">
    {{ csrf_field() }}
	{{ method_field('PATCH') }}



    <div>
    <div class="form-group">
        <label for="firstname">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $debit->debtor}}"  id="name"  placeholder="Enter  Name" >
      </div>
     <div class="form-group">
        <label for="number">Amount</label>
        <input type="number" name="amount" class="form-control" value="{{ $debit->amount}}"  id="name"  placeholder="Enter  Amount" >
      </div>

      <div class="form-group">

        <label for="fund" >Fund</label>
        <div class="form-group">
            <select id="fund" name="fund" class="form-control" >
                <option value="{{ $selected_box->id }}"> {{ $selected_box->name }} </option>
            @foreach($boxlist as $id=>$name)


    <option value="{{ $id }}"> {{ $name }} </option>

 @endforeach
 </select></div></div>



 <div class="form-group">

    <label for="store" >Store</label>
    <div class="form-group">
        <select id="store" name="store" class="form-control" >
            <option value="{{ $selected_market->id }}"> {{ $selected_market->name }} </option>
        @foreach($marketlist as $id=>$name)


<option value="{{ $id }}"> {{ $name }} </option>

@endforeach
</select></div></div>


      <div class="form-group">
      <label for="time">Time:</label><br>
      <input type="datetime-local" style="width:40%;hight:30%;" name="time" value="{{str_replace(' ','T',$debit->time)}}"  value="2017-06-01T08:30" placeholder="Enter Time......." value="" required>
      </div>




    </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
