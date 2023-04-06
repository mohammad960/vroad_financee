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

<h2>Users</h2>

<div>
<button class="btn btn-primary" id="export" style="float:right;color:black;background-color:white;"> <i class='fas fa-file-export'aria-hidden="true"></i>  Export </button>
<a href="{{ route('user.create') }}" class="btn btn-primary" style="float:right;color:black;background-color:white;"> <i class="fa fa-plus" aria-hidden="true"></i>  Create </a>
</div>
</br>
</br>
<div Style="background-color:white;border-top:solid 3px white;padding:2%;">
 @if ($message = Session::get('success'))
        <div id="not" class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
		<script>
		setTimeout(function() {
    $('#not').fadeOut('fast');
}, 3000); //
		</script>
    @endif
     <div>
	<div class="table-responsive">
          <table id="table_id" class="display">
               <thead>
                    <tr>
						<th>User Name</th>
						<th>Store</th>

						<th>Role</th>

						 <th>action</th>

                         <th>Disable</th>
                        <th>Delete</th>
                    </tr>
               </thead>
               <tbody>

               </tbody>
          </table>
		  </div>
          <br>
          <hr>

          <hr>
     </div>

     <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Show User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </div>

          <div class="modal-body">
            <p><strong>ID:</strong> <span id="user-id"></span></p>
            <p><strong>Name:</strong> <span id="username"></span></p>
            <p><strong>Role:</strong> <span id="role"></span></p>
            <p><strong>Store:</strong> <span id="store"></span></p>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary"onclick="cancel()" data-bs-dismiss="myModal">Close</button>
          </div>
        </div>
        </div>
        </div>

     <script>
	 		 $( "#export" ).click(function() {
                console.log("hii");
  $( ".export-button" ).click();
});
          $(document).ready( function () {
			  		  function newexportaction(e, dt, button, config) {
                        console.log("hii222");
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
                         url : "{{'pagination-user'}}",
                    },
                    /* Here Its gonna put the Data on the table.. By (#table_id) */
                    columns: [
                         {data:'username'},
						  {data:'store'},

						  {data:'role'},



						   {data:'action'},

                         {data:'Disable'},
                         {data:'Delete'}

                    ],
					"dom": 'Blfrtip',
                    "buttons": [

                        {exportOptions:{
       columns: [0,1,2]
 },
                            "extend": 'excel',
							"className": 'export-button' ,

                            "text": '<button class="btn" ><i class="fa fa-file-excel-o" style="color: green;"></i>  Export</button>',
                            "titleAttr": 'Excel',

                            "action": newexportaction
                        },
                    ],
               });



// setTimeout(function() {
//     $('.popup').on('click', function(event){
//     console.log("hello");
//   });

// }, 1000);




          });

          function clickme(id){

    var userURL = '/user/'+id+'/show';

 $.ajax({
     url: userURL,
     type: 'GET',
     dataType: 'json',
     success: function(data) {

         $('#user-id').text(data.id);
         $('#username').text(data.username);
         $('#role').text(data.role.name);
         $('#store').text(data.market?data.market.name:'ALL');

     }

 });
}
function cancel(){

    $('#myModal').modal('hide');

}

console.log("hello3");
     </script>

</body>
</html>

@endsection
