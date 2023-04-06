@extends('adminlte::page')

@section('content')

  
 
<div class="container">
 
   <div class="card" style="border-top:solid 3px blue;margin-top:1%;">
  <div class="card-header">
  
    <h3 class="card-title"><h2> <i> Details For user: <h2 style="color:#3366ff;">{{$user->name}}</h2>  </i> </h2></h3></h3>
    
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
     <div class="table-responsive">
    <table class="table table-bordered table-striped" id="preview-table" style="color:#3366ff;" >
       <thead>
          
       </thead>
	  <tbody>
	 
  <tr>


    <tr>
           <th>username</th>
		   <th>{{$user->username}}</th>
    </tr>
	
        

           
		   
	
		     </tr>
  </tr>
 

	  </tbody>
    </table>
   <div class="pull-right">
            <a class="btn btn-primary" style="background-color: #4CAF50;border: 2px solid #4CAF50;" href="{{ route('user.index') }}"> Back</a>
        </div>
 </div>
  </div>
  
  <!-- /.card-body -->
</div>
   
 
</div>

@endsection 