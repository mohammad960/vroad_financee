{{-- AdminLTE --}}
@extends('adminlte::page')
@section('content')

<!DOCTYPE html>
<html lang="en">
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



<body>
<div Style="background-color:white;border-top:solid 3px blue;padding:2%;">
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
			<div class="text-left" style="
			margin-left: 15px;
			">

			<button type="text" id="btnFiterSubmitSearch" onClick="filterTime()" class="btn btn-info">Submit</button>

			</div>

    </div>
	</br>
	<div Style="background-color:white;border-top:solid 3px blue;padding:2%;">
		    <h2>History For Costs</h2>
				<div class="table-responsive">
      <table id="table_id" class="display" >
               <thead>
                    <tr>
					<th>User</th>
						<th>Amount</th>
						<th>Category cost</th>
						<th>Box</th>
						<th>Market</th>
						 <th>action</th>

                         <th>Delete</th>
                    </tr>
               </thead>
               <tbody>

               </tbody>
          </table>
		   </div>
          </br>
		  </div>
		  <div Style="background-color:white;border-top:solid 3px blue;padding:2%;">
		    <h2>History For Salary</h2>
		   <table id="table_id_salary" class="display" >
               <thead>
                    <tr>
					<th>User</th>
						<th>Amount</th>
						<th>Employee</th>
						<th>Box</th>
						<th>Market</th>
						 <th>action</th>

                         <th>Delete</th>
                    </tr>
               </thead>
               <tbody>

               </tbody>
          </table>
		  </div>
          </br>
          <hr>
          <div class="links">
               <a href="{{ route('history.create') }}" class="btn btn-primary"> Create </a>
          </div>
          <hr>
     </div>
</div>
     <script>

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
                         url : "{{'pagination-history'}}",
						  data: function (d) {
							d.start_time = $('#start_date').val();
							d.end_time = $('#end_date').val();
							d.group = $("#group").val();
							} ,

						dataType: "json",
                    },
                    /* Here Its gonna put the Data on the table.. By (#table_id) */
                    columns: [
					  {data:'user'},
                         {data:'amount'},
						 {data:'cost'},
						 {data:'box'},
						 {data:'market'},
						   {data:'action'},

                         {data:'delete'},

                    ],
					"dom": 'Blfrtip',
                    "buttons": [
                        {exportOptions:{
       columns: [0,1,2,3,4]
 },
                            "extend": 'excel',
							"className": 'btn btn-primary glyphicon glyphicon-save-file margin ' ,

                            "text": '<button class="btn" ><i class="fa fa-file-excel-o" style="color: green;"></i>  Export</button>',
                            "titleAttr": 'Excel',

                            "action": newexportaction
                        },
                    ],
               });


			           $('#table_id_salary').DataTable({
							processing:true,
							serverSide:true, /*To send the [start ,length ,search]*/

							ajax:{
								 url : "{{'pagination-salary'}}",
								  data: function (d) {
									d.start_time = $('#start_date').val();
									d.end_time = $('#end_date').val();
									d.group = $("#group").val();
									} ,

								dataType: "json",
							},
							/* Here Its gonna put the Data on the table.. By (#table_id) */
							columns: [
							{data:'user'},
								 {data:'amount'},
								 {data:'employee'},
								 {data:'box'},
								 {data:'market'},
								   {data:'action'},

								 {data:'delete'},

							],
							"dom": 'Blfrtip',
							"buttons": [
								{exportOptions:{
       columns: [0,1,2,3,4]
 },
									"extend": 'excel',
									"className": 'btn btn-primary glyphicon glyphicon-save-file margin ' ,

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
    }
     </script>

</body>
</html>

@endsection
