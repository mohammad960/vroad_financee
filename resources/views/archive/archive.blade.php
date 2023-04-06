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

 <h2>Details Archive</h2>
<div>
<button class="btn btn-primary" id="export" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  Export </button>
   <button type="text" id="btnFiterSubmitSearch" onClick="filterTime()" class="btn btn-primary" style="float:right;color:black;background-color:white;"> <i class="fa fa-paper-plane" aria-hidden="true"></i>  Submit </button>
  <a href="{{ route('archive.create') }}" class="btn btn-primary" style="float:right;color:black;background-color:white;"> <i class="fa fa-plus" aria-hidden="true"></i>  Create </a>
</div>
</br>
</br>
<div Style="background-color:white;border-top:solid 3px white;padding:2%;">
     <div>

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
    <h5>Accounting Fund <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" id="box_id">
		<option value="">All</option>
		@foreach ($box as $m)
		<option value="{{$m->id}}">
			{{$m->name}}
		</option>
		@endforeach
		</select>
    </div>
	   </div>
	   @if(Auth::user()->role_id==1)
   	 <div class="form-group col-md-6">
    <h5>Store <span class="text-danger"></span></h5>
    <div class="controls">
        <select class="form-control" id="market_id">
		<option value="">All</option>
		@foreach ($market as $m)
		<option value="{{$m->id}}">
			{{$m->name}}
		</option>
		@endforeach
		</select>
    </div>
	   </div>
   @endif
    </div>

	</div>
		<div class="table-responsive">
          <table id="table_id" class="display">
               <thead>
                    <tr>
					 <th>User</th>
					  <th>Time</th>
					   <th>Fund</th>
					<th>Category</th>
					<th>Sub-Category</th>
					<th>Debit</th>
				<th>Credit</th>
				<th>Balance</th>
				<th>Method</th>
				<th>Tax</th>
			    <th>Declared</th>
				<th>Store</th>
					<th></th>
                    </tr>
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
               $('#table_id').DataTable({
                    processing:true,
                    serverSide:true, /*To send the [start ,length ,search]*/

                    ajax:{
                         url : "{{'pagination-archive'}}",
						  data: function (d) {
							d.start_time = $('#start_date').val();
							d.end_time = $('#end_date').val();
							d.box_id = $("#box_id").val();
							d.market_id = $("#market_id").val();
							} ,

						dataType: "json",
                    },
                    /* Here Its gonna put the Data on the table.. By (#table_id) */
                    columns: [
					{data:'user'},
                      {data:'time'},
					   {data:'box'},
					 {data:'cat'},
					 {data:'sub'},
					 {data:'debit'},
				 {data:'credit'},
				 {data:'balance'},
				 {data:'method'},
				 {data:'tax'},
			   {data:'declared'},
				 {data:'store'},
						 {data:'restore'},
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

</script>
</body>
</html>

@endsection
