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

<h2>Details Inventory</h2>

<div >
<button class="btn btn-primary" id="export" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  Export </button>
  <button class="btn btn-primary"  id="btnFiterSubmitSearch" onClick="filterTime()"  style="float:right;color:black;background-color:white;"> <i class="fa fa-paper-plane" aria-hidden="true"></i>  Sumbit </button>

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
						<th>Balance</th>

					<th>Store</th>
						<th>Action</th>
                    </tr>
               </thead>
               <tbody>

               </tbody>
          </table>
		  </div>
          <br>
          <hr>
   <div class="row" id="chartline1">
<canvas id="ChartBar"  style="width:20%;max-width:500px"></canvas>

<canvas id="ChartLine"  style="margin-left:1%;width:20%;max-width:500px"></canvas>

     </div>
	 <div class="row" id="chartline2">

	 <canvas id="ChartPie"  style="margin-left:1%;width:20%;max-width:500px"></canvas>
	 </div>
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
                         url : "{{'pagination-good'}}",
						  data: function (d) {
							d.start_time = $('#start_date').val();
							d.end_time = $('#end_date').val();

							d.market_id = $("#market_id").val();
							} ,

						dataType: "json",
                    },
                    /* Here Its gonna put the Data on the table.. By (#table_id) */
                    columns: [
					{data:'user'},
                      {data:'time'},

				 {data:'balance'},


				 {data:'store'},
						 {data:'action'},
                    ],
					"dom": 'Blfrtip',
                    "buttons": [
                        {exportOptions:{
       columns: [0,1,2,3]
 },
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

    }
     </script>

</body>
</html>

@endsection
