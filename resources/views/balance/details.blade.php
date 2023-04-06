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
<body>

<h2>Balance</h2>
<div >
		<button class="btn btn-primary" onclick="dowExel()" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  Excel Balance </button>

			<button class="btn btn-primary" id="export" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  Export </button>
             <button class="btn btn-primary"  id="btnFiterSubmitSearch" onClick="filterTime()"  style="float:right;color:black;background-color:white;"> <i class="fa fa-paper-plane" aria-hidden="true"></i>  Sumbit </button>
	<button class="btn btn-primary" onClick="showSheet()" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  View </button>

 </div>
</br>
</br>
<div Style="background-color:white;border-top:solid 3px white;padding:2%;">
     <div>


   <div class="row">
    <div class="form-group col-md-3">
    <h5>Start Date <span class="text-danger"></span></h5>
    <div class="controls">
        <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
    </div>
    <div class="form-group col-md-3">
    <h5>End Date <span class="text-danger"></span></h5>
    <div class="controls">
        <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
    </div>
		  	 <div class="form-group col-md-3">
    <h5>Select Store:<span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" id="store_id" name="store_id" style="float:right;" >
	   @foreach($market as $m)
		<option value="{{$m->id}}">{{$m->name}}</option>
	@endforeach
		</select>
    </div>
	   </div>


	  	 <div class="form-group col-md-3">
    <h5>Group By <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" id="choices-multiple-remove-button"  name="box_id[]" style="float:right;" >

		<option value="market_id">Store</option>
		<option value="box_id">Fund</option>

		</select>
    </div>
	   </div>


    </div>


	</div>
	<div class="table-responsive">
          <table id="table_id" class="display">
               <thead>
                    <tr>
				 <th>Group By</th>
					 <th>Total Income</th>
					 <th>Total Expense</th>
					 <th>Balance</th>

               </thead>
               <tbody>

               </tbody>
          </table>
		  </div>
          <br>
          <hr>

</div>



     <script>
	  $( "#export" ).click(function() {

  $( ".export-button" ).click();
});
     $(document).ready( function () {
			  		  function newexportaction(e, dt, button, config) {
         var self = this;
         var oldStart = dt.settings()[0]._iDisplayStart;
         dt.one('preXhr', function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one('preDraw', function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf('buttons-copy') >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-print') >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one('preXhr', function (e, s, data) {
                     // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                     // Set the property to what it was before exporting.
                     settings._iDisplayStart = oldStart;
                     data.start = oldStart;
                 });
                 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                 setTimeout(dt.ajax.reload, 0);
                 // Prevent rendering of the full data to the DOM
                 return false;
             });
         });
         // Requery the server with the new one-action export settings
         dt.ajax.reload();
     };
             var table=  $('#table_id').DataTable({
                    processing:true,
                    serverSide:true, /*To send the [start ,length ,search]*/
responsive: true,
                    ajax:{
                         url : "{{'pagination-balance'}}",
						  data: function (d) {
							d.start_time = $('#start_date').val();
							d.end_time = $('#end_date').val();
							d.group = $("#choices-multiple-remove-button").val();



							} ,

						dataType: "json",
                    },
                    /* Here Its gonna put the Data on the table.. By (#table_id) */
                    columns: [
					{data:'group'},
					{data:'total_in'},
                      {data:'total_ex'},
					   {data:'balance'},

                    ],
					"dom": 'Blfrtip',
                    "buttons": [
                        {
                            "extend": 'excel',
							"className": 'export-button' ,

                            "text": '<button class="btn" ><i class="fa fa-file-excel-o" style="color: green;"></i>  Export</button>',
                            "titleAttr": 'Excel',

                            "action": newexportaction
                        },
                    ],
               });



          });

function filterTime(){

     $('#table_id').DataTable().ajax.reload();
	 $('#table_id_salary').DataTable().ajax.reload();

	$('#ChartPie').remove(); // this is my <canvas> element
	$('#chartline2').append('<canvas id="ChartPie" style="margin-left:1%;width:20%;max-width:500px"><canvas>');
	$('#ChartBar').remove(); // this is my <canvas> element
	$('#chartline1').append('<canvas id="ChartBar" style="margin-left:1%;width:20%;max-width:500px"><canvas>');
	$('#ChartLine').remove(); // this is my <canvas> element
	$('#chartline1').append('<canvas id="ChartLine" style="margin-left:1%;width:20%;max-width:500px"><canvas>');

   chart();
    }
     </script>
<script>
   chart();
function chart(){

$.ajax({
							url : "{{'chartLine'}}",
							data:{"box_id":$("#box_id").val(),"end_date":$('#end_date').val(),"start_date":$('#start_date').val()},
							dataType: "json",
						success: function(data) {

							var xValues = data['date'];

							new Chart("ChartLine", {
							  type: "line",
							  data: {
								labels: xValues,
								datasets: [{
								  data: data['history'],
								  borderColor: "red",
								  fill: false
								}]
							  },
							  options: {
								legend: {display: false},
								title: {
							  display: true,
							  text: "Accounting Found Details For Fund "+$("#box_id").val()
							}
							  }
							});

						}
                    });
 $.ajax({
							url : "{{'chartBar'}}",
							 method:"GET",
								data:{"market_id":$("#market_id").val()},

						dataType: "json",
						success: function(data) {
							var xValues = data['box'];
							var yValues = data['balance'];
							var barColors = data['color'];

						new Chart("ChartBar", {
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
							  text: "Accounting Found"
							}
						  }
						});

						}
                    });
					 $.ajax({
							url : "{{'chartPie'}}",
							 method:"GET",
						data:{"box_id":$("#box_id").val(),"end_date":$('#end_date').val(),"start_date":$('#start_date').val(),"market_id":$("#market_id").val()},

						dataType: "json",
						success: function(data) {
							var xValues = data['cat'];
							var yValues = data['value'];
							var barColors = data['color'];
							var canvas=document.getElementById('ChartPie');
							var context=canvas.getContext('2d');
							context.clearRect(0,0,canvas.width,canvas.height);
							new Chart("ChartPie", {
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
								  text: "Category Log"
								}
							  }
							});
									}
                    });
}
function showSheet(){
	if($('#end_date').val() && $('#start_date').val()){
	window.location.href = window.location.href+"/sheet?start="+$('#start_date').val()+"&end="+$('#end_date').val()+"&store="+$('#store_id').val();
	}else{
		alert('Enter start and end date');
	}

}
function dowExel(){
	if($('#end_date').val() && $('#start_date').val()){
	window.location.href = window.location.href+"/getecxel?start="+$('#start_date').val()+"&end="+$('#end_date').val()+"&store="+$('#store_id').val();
	}else{
		alert('Enter start and end date');
	}
}

</script>
</body>
</html>

@endsection
