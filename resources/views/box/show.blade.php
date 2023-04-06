@extends('adminlte::page')
<head>
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js" defer></script>
<style>
#outside {
  background-color: green;
  width: 100%;
  height: 100px;
}
</style>
     <style>
          h2 {
               color: darkblue;
               text-align: center;
               font-size: 35px;
               font-weight: bold;
          }
     </style>
</head>

@section('content')



<div class="container">

   <div class="card" style="border-top:solid 3px blue;margin-top:1%;">
  <div class="card-header">

    <h3 class="card-title"><h2> <i> Details For Box: <h2 style="color:#3366ff;"></h2>  </i> </h2></h3></h3>
      <div class="row">
    <div class="form-group col-md-6">
    <h5>Start Date <span class="text-danger"></span></h5>
    <div class="controls">
        <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
    </div>
    <div class="form-group col-md-6">
    <h5>End Date <span class="text-danger"></span></h5>
    <div class="controls">
        <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
    </div>


	  	 <div class="form-group col-md-6">
    <h5>Fund <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" id="box_id">
		<option value="All">All</option>
		@foreach ($box as $m)
		<option value="{{$m->id}}">
			{{$m->name}}
		</option>
		@endforeach
		</select>
    </div>
	   </div>
    <div class="text-left" style="
    margin-left: 15px;
    ">

    <button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Submit</button>

	</div>

    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body">
     <div class="table-responsive">
    <table class="table table-bordered table-striped" id="preview-table" style="color:#3366ff;" >
       <thead>
	    <th>Time</th>
          <th>Category</th>
		   <th>Sub-Category</th>
		    <th>Debit</th>
			 <th>Credit</th>
			  <th>Balance</th>
			  <th>Method</th>
			   <th>Tax</th>
			    <th>Declared</th>
		  <th>Store</th>

       </thead>
	   <tbody>
	   @foreach ($history as $h)
	   <tr>
	   <td>{{$h['time']}}</td>
	   <td>{{$h['cat']}}</td>
	    <td>{{$h['sub']}}</td>
	    <td>{{$h['debit']}}</td>
	   <td>{{$h['credit']}}</td>
	    <td>{{$h['balance']}}</td>

		   <td>{{$h['method']}}</td>
		     <td>{{$h['tax']}}</td>
		   <td>{{$h['declared']}}</td>
		   <td>{{$h['store']}}</td>
	   </tr>
	   @endforeach

	   </tbody>
	  <tbody>


	  </tbody>
    </table>
   <div class="pull-right">
            <a class="btn btn-primary" style="background-color: #4CAF50;border: 2px solid #4CAF50;" href="{{ route('box.index') }}"> Back</a>
        </div>
 </div>
  </div>

  <!-- /.card-body -->
</div>


</div>

@endsection
