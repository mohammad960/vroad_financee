@extends('adminlte::page')
@section('title', '')
<link href="https://fonts.googleapis.com/css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
<div Style="background-color:white;border-top:solid 3px blue;padding:2%;">
     <form  >
			 
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
    <h5>Market <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" value="market">
		<option value="All">All</option>
		@foreach ($markets as $m)
		<option value="{{$m->name}}">
			{{$m->name}}
		</option>
		@endforeach
		</select>
    </div> 
	   </div> 
	   
	  	 <div class="form-group col-md-6">
    <h5>Box <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" value="market">
		<option value="All">All</option>
		@foreach ($box as $m)
		<option value="{{$m->name}}">
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
	</form>

<canvas id="myChart"  style="width:20%;max-width:400px"></canvas>


</div>

<script>
var xValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("myChart3", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    }, { 
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    }, { 
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
</script>
<script>
var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValues = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
</script>

<script>

 
var xValues = <?php echo json_encode($markets); ?>;
var yValues = [55, 49];
var barColors = ["red", "green"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Markets"
    }
  }
});
  
</script>
@stop
@section('footer')
<div style="color:red">
copy right by ali
</div>
@stop
