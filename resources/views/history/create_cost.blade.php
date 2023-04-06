<!DOCTYPE html>
<html lang="en" style="background: #f3f3f3;" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/quiz.css')}}">
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <title>Finance - Home</title>
</head>
<body style="background: #f3f3f3;">

    <header style="background: url(../../img/login_bg.png);" >
        <div id="top" >
            <div id="first" >Financial Entry</div>
            <div id="last" >
            <a  onclick=""> <div id="last_dashboard" style="color:white;" > <i style="transform: rotate(180deg);margin: 0 3px;color:white;" class="fa fa-sign-in" aria-hidden="true"></i>   Back To Dashboard</div> </a> </div>
        </div>
        <nav>
            <div id="list" >
                <div class="list-container">
				<?php $tab = Session::get('tab');?>
				    @if (!isset($tab))
						<span class="list-item active-item">Income</span>
						<span class="list-item">Expense</span>
					    <span class="list-item" hidden></span>
						<span class="list-item">Depit</span>
						<span class="list-item">Inventory</span>
					@else
						@if($tab  ==3)
							<span class="list-item active-item">Income</span>
						@else
							<span class="list-item">Income</span>
						@endif
						@if($tab ==2)
							<span class="list-item active-item">Expense</span>
						@else
							<span class="list-item">Expense</span>
						@endif
						    <span class="list-item" hidden></span>
						@if($tab =='debit')
							<span class="list-item active-item">Depit</span>
						@else
							<span class="list-item">Depit</span>
						@endif
						@if($tab =='good')
							<span class="list-item active-item">Inventory</span>
						@else
							<span class="list-item">Inventory</span>
						@endif
					@endif


                </div>
            </div>
        </nav>
    </header>
     @if ($message = Session::get('success'))
		 </br>
   <center> <div id="not" style="width:60%;height:50px;background-color:#20B2AA;border-radius: 50px;padding:1%;">
          <center>  <p style="color:white;">{{ $message }} </p></center>
        </div>
		</center>
     	<script>
		setTimeout(function() {
			$('#not').fadeOut('fast');
			}, 3000); //
		</script>

    @endif
    <main class="main-container" >


        <section id="Income" >

	  <form id="quiz" action="{{route('saveCost')}}" method="POST"enctype="multipart/form-data">
	  {{ csrf_field() }}
               <div id="dialog-data" >
                <label id=_1 class="my-3" >What Type for Your Entry?</label>
                <select class="form-select rounded-5 my-3" aria-label="Default select example" name="category_parent_income" id="category_parent">

				@foreach ($category_income as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>

				@endforeach
                    </select>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >What Type for Your Category Entry (Sub-Category)?</label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example" name="sub_cat" id="sub_cat" required>


                    </select>
               </div>
			   @if (Auth::user()->role_id==1)
			    <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Select Store ?</label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example" name="store" id="store">
                      	@foreach ($stores as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>

						@endforeach

                    </select>
               </div>
			   @endif
               <!-- this need date -->
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Choose The Fund</label>
					@foreach ($funds as $f)

						   <div class="form-check">
							<input class="form-check-input" type="radio" name="fund" value="{{$f->id}}" id="flexRadioDefault{{$f->id}}" required>
							<label class="form-check-label" for="flexRadioDefault1">
								{{$f->name}}
							</label>
						</div>
					@endforeach


                    <label id="normal-label" class="my-3" >Choose Invoice Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" value="cache" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Cash
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" value="check" required checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Check
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" value="transfer" required checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Transfer
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Check INFO</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="number_check" placeholder="name@example.com">
                        <label for="floatingInput">Number Check</label>
                    </div>
                    <!-- DATE FIELD  -->
                    <label for="inputCheckin">Date Check</label>
                    <input type="datetime-local" id="inputCheckin"  class="form-control mb-4" placeholder="Date Check" name="date_check" autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="to_who" placeholder="name@example.com">
						 <input type="text" value="3" name="type" hidden>
                        <label for="floatingInput">Person Who Take a check</label>
                    </div>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Amount</label>
                    <div class="form-floating mb-3">
                        <input type="number" step="0.00001" class="form-control rounded-5" id="floatingInput" name="balance" required placeholder="name@example.com">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Amount Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="state" value="debit" checked required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Debit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" value="credit"  required >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Credit
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Tax Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"   name="tax" value="1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Tax
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="tax" value="0"  >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Tax
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Declared Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="declared" value="1"  >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Declared
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="declared" value="0"  >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Declared
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Invoice Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="invoice" value="1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Invoice
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="invoice" value="0" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Invoice
                        </label>
                    </div>
               </div>
               <!-- this need date -->
               <div id="dialog-data" >
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here"  name="note" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Notes</label>
                  </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="time_income"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                        </div>
                    <div id='attach' style="cursor: pointer;" >
                        <input accept="image/*" type='file' id='file-inp' name="image" style="display: none;" />
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                    </div>
                </div>
                    <center>
				    <p id="error" style="color:red;"></p>
				  <button type="submit" id="submit">Send</button>
			  <a id="cancel1" class="cancel">Cancel</a>
				   </center>
                		</form>
            </section>


            <section id="Expense"  style="display: none;" >
				<form id="quiz" action="{{route('saveCost')}}" method="POST"enctype="multipart/form-data">
					{{ csrf_field() }}
                <div id="dialog-data" >
                 <label id=_1 class="my-3" >What Type for Your Entry?</label>
                 <select class="form-select rounded-5 my-3" aria-label="Default select example" name="" id="category_parent_expense">
                     
                   @foreach ($category_expense as $c)
                    <option value="{{$c->id}}">{{$c->name}}</option>

				@endforeach
                    </select>
                     </select>
                 </div>
                 <div id="dialog-data" >
                     <label id="normal-label" class="my-3" >What Type for Your Category Entry (Sub-Category)?</label>
                     < <select class="form-select rounded-5 my-3" aria-label="Default select example" required name="sub_cat" id="sub_cat_expense">




                     </select>
                </div>
				 @if (Auth::user()->role_id==1)
			    <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Select Store ?</label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example" required name="store" id="store">
                      	@foreach ($stores as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>

						@endforeach

                    </select>
               </div>
			   @endif
                <!-- this need date -->
                 <div id="dialog-data" >
                     <label id="normal-label" class="my-3" >Choose the Fund</label>
                   	@foreach ($funds as $f)

						   <div class="form-check">
							<input class="form-check-input" type="radio" name="fund" value="{{$f->id}}" required id="flexRadioDefault{{$f->id}}" required>
							<label class="form-check-label" for="flexRadioDefault1">
								{{$f->name}}
							</label>
						</div>
					@endforeach
                      <label id="normal-label" class="my-3" >Choose Invoice status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" required value="cache" checked >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Cash
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" required value="check" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Check
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="method" required value="transfer"  >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Transfer
                        </label>
                    </div>

                    <label id="normal-label" class="my-3" >Check INFO</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="number_check" placeholder="name@example.com">
                        <label for="floatingInput">Number Check</label>
                    </div>
                    <!-- DATE FIELD  -->
                    <label for="inputCheckin">Date Check</label>
                    <input type="datetime-local" id="inputCheckin"  class="form-control mb-4" placeholder="Date Check" name="date_check" autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="to_who" placeholder="name@example.com">
						 <input type="text" value="2" name="type" hidden>
                        <label for="floatingInput">Person Who Take a check</label>
                    </div>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Amount</label>
                    <div class="form-floating mb-3">
                        <input type="number" step="0.0001" class="form-control rounded-5" id="floatingInput" required name="balance" placeholder="name@example.com">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Amount Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="state"required  value="debit" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Debit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" required value="credit"  checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Credit
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Tax Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"   name="tax" value="1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Tax
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="tax" value="0"  >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Tax
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Declared Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="declared" value="1"  >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Declared
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="declared" value="0"  >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Declared
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Invoice Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  name="invoice" value="1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Invoice
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="invoice" value="0" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Invoice
                        </label>
                    </div>
               </div>
               <!-- this need date -->
               <div id="dialog-data" >
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here"  name="note" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Notes</label>
                  </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="time_exp"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                        </div>
                    <div id='attach' style="cursor: pointer;" >
                        <input accept="image/*" type='file' id='file-inp' name="image" style="display: none;" />
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                    </div>
                </div>
                    <center>
				    <p id="error" style="color:red;"></p>
				  <button type="submit" id="submit">Send</button>
				    <a id="cancel2" class="cancel">Cancel</a>

				   </center>
                </form>
        </section>
        <section id="Salary"  style="display: none;" >
            Salary
        </section>

        <section id="Depit"  style="display: none;" >
		  <form  action="{{route('debit.store')}}" method="POST" enctype="multipart/form-data">
		  {{ csrf_field() }}
            <div id="dialog-data" >
                <label id=_1 class="my-3" >Insert New Depit</label>
                </br>
                     @if (Auth::user()->role_id==1)
                    <label id="normal-label" class="my-3" >Select Store ?</label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example" name="market_id" id="store">
                      	@foreach ($stores as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>

						@endforeach

							</select>
					@endif

                    <label id="normal-label" class="my-3" >Choose the Fund</label>
                    	@foreach ($funds as $f)

						   <div class="form-check">
							<input class="form-check-input" type="radio" name="box_id" required value="{{$f->id}}" id="flexRadioDefault{{$f->id}}">
							<label class="form-check-label" for="flexRadioDefault1">
								{{$f->name}}
							</label>
						</div>
					@endforeach
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Amount</label>
                    <div class="form-floating mb-3">
                        <input type="numner" step="0.0001" class="form-control rounded-5" id="floatingInput" required name="amount" placeholder="name@example.com">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Amount Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Debit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type"  id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Credit
                        </label>
                    </div>
                     <div class="form-floating">
                        <input class="form-control my-4" placeholder="Leave a comment here" required name="debtor" />
                        <label for="floatingTextarea">Debetor</label>
                      </div>
                     <div class="form-floating">
                        <input class="form-control my-4" placeholder="Leave a comment here" name="note" />
                        <label for="floatingTextarea">Note</label>
                      </div>
                        <!-- DATE -->
                        <div class="form-label-group">
                            <input type="datetime-local" id="time_depit"  class="form-control my-3" required placeholder="mm/dd/yyy" name="time" autocomplete="off">
                            </div>
                        <div id='attach' style="cursor: pointer;" >
                        <input type='file' id='file-inp2' accept="image/*"  name="image" style="display: none;" />
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                        </div>
                </div>
                 <center>
				    <p id="error" style="color:red;"></p>
				  <button type="submit" id="submit">Send</button>
				    <a id="cancel3" class="cancel">Cancel</a>

				   </center>
        </form>
		</section>

        <section id="Inventory"  style="display: none;" >

		  <form  action="{{route('good.store')}}" method="POST" enctype="multipart/form-data">

				{{ csrf_field() }}
            <div id="dialog-data" >
                <label id=_1 class="my-3" >Update Inventory Stores</label>
				 </br>
                @if (Auth::user()->role_id==1)
                    <label id="normal-label" class="my-3" >Select Store ?</label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example" required name="market_id" id="store">
                      	@foreach ($stores as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>

						@endforeach

							</select>
					@endif
                </div>
            <div id="dialog-data" >
                <div class="form-floating">
                    <input class="form-control" placeholder="Leave a comment here" type="number" required step="0.00000000000001" name="amount"></textarea>
                    <label for="floatingTextarea">Amount</label>
                    </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="time_inv"  class="form-control my-3" required placeholder="mm/dd/yyy"  name="time" autocomplete="off">
                        </div>
                    <div id='attach' style="cursor: pointer;" >
                        <input type='file' accept="image/*" id='file-inp3' name="image" style="display: none;" />
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                    </div>
                </div>
         <center>
				    <p id="error" style="color:red;"></p>
				  <button type="submit" id="submit">Send</button>
				  <a id="cancel4" class="cancel">Cancel</a>
				   </center>
				  </form>
        </section>

    </main>
<div id="myModal" class="modal">
<center>
<div id="dialog-data"  style="background-color:#D8D8D8;border:solid #707070 2px;" >
    <p style="font-size:40px;">Are you sure to cancel what you entered?</p>
  <button type="submit" id="submit" onclick="location.href = '/viewCost';" style="background-color:green;" >YES</button>
  <button class="close" id="close" style="background-color:red;">NO</button>
  </center>
  </div>
</div>
<div id="dashboardModel" class="modal">
<center>
  <!-- Modal content -->
  <div id="dialog-data"  style="background-color:#D8D8D8;border:solid #707070 2px;" >
    <p style="font-size:50px;">Are you sure to return to dashboard?</p>
  <button type="submit" id="submit" onclick="location.href = '/';" style="background-color:green;" >YES</button>
  <button class="close" id="close_dash" style="background-color:red;">NO</button>
  </center>
  </div>
</div>
<script src="/js/qz.js"></script>
<script>
$('#category_parent').on('change', function() {
		$('#sub_cat')
			.find('option')
			.remove()
			.end();
		 $.ajax({
                url: '{{"child"}}', // sending ajax request to this server page
                type: 'get',
                dataType: "json",
                data: {
                   'parent': $('#category_parent').find(":selected").val()          },
                success: function (response) {
					$.each(response, function (i, item) {

						$('#sub_cat').append($('<option>', {
							value: item.id,
							text : item.name
						}));
					});

									}
             });
         event.preventDefault();

});

$('#sub_cat')
			.find('option')
			.remove()
			.end();
		 $.ajax({
                url: '{{"child"}}', // sending ajax request to this server page
                type: 'get',
                dataType: "json",
                data: {
                   'parent': $('#category_parent').find(":selected").val()          },
                success: function (response) {
					$.each(response, function (i, item) {

						$('#sub_cat').append($('<option>', {
							value: item.id,
							text : item.name
						}));
					});

									}
             });
</script>
<script>
 document.getElementById("time_income").defaultValue = new Date().toISOString().substring(0, 21);
  document.getElementById("time_exp").defaultValue = new Date().toISOString().substring(0, 21);
  document.getElementById("time_depit").defaultValue = new Date().toISOString().substring(0, 21);
  document.getElementById("time_inv").defaultValue = new Date().toISOString().substring(0, 21);


$('#category_parent_expense').on('change', function() {
		$('#sub_cat_expense')
			.find('option')
			.remove()
			.end();
		 $.ajax({
                url: '{{"child"}}', // sending ajax request to this server page
                type: 'get',
                dataType: "json",
                data: {
                   'parent': $('#category_parent_expense').find(":selected").val()          },
                success: function (response) {
					$.each(response, function (i, item) {

						$('#sub_cat_expense').append($('<option>', {
							value: item.id,
							text : item.name
						}));
					});

									}
             });
         event.preventDefault();

});

$('#sub_cat_expense')
			.find('option')
			.remove()
			.end();
		 $.ajax({
                url: '{{"child"}}', // sending ajax request to this server page
                type: 'get',
                dataType: "json",
                data: {
                   'parent': $('#category_parent_expense').find(":selected").val()          },
                success: function (response) {
					$.each(response, function (i, item) {

						$('#sub_cat_expense').append($('<option>', {
							value: item.id,
							text : item.name
						}));
					});

									}
             });
</script>
<script>

window.onload = () => {

			var tab="{{Session::get('tab')}}";
			if (tab==3){
				document.getElementById("Expense").style.display = "none";
				document.getElementById("Income").style.display = "flex";
				document.getElementById("Depit").style.display = "none";
				document.getElementById("Inventory").style.display = "none";
			}
			if (tab==2){
				document.getElementById("Expense").style.display = "flex";
				document.getElementById("Income").style.display = "none";
				document.getElementById("Depit").style.display = "none";
				document.getElementById("Inventory").style.display = "none";
			}
			if (tab=='debit'){
				document.getElementById("Expense").style.display = "none";
				document.getElementById("Income").style.display = "none";
				document.getElementById("Depit").style.display = "flex";
				document.getElementById("Inventory").style.display = "none";
			}
			if (tab=='good'){
				document.getElementById("Expense").style.display = "none";
				document.getElementById("Income").style.display = "none";
				document.getElementById("Depit").style.display = "none";
				document.getElementById("Inventory").style.display = "flex";
			}
            var tabs = document.querySelectorAll('.list-item');
            var sections = document.querySelectorAll('section');
            var attaches = document.querySelectorAll('#attach');

            attaches.forEach(attach => {
                attach.addEventListener('click', function(){
                    attach.firstElementChild.click();
                })
            });

            tabs.forEach((tab,i) => {
                tab.addEventListener('click', function(){
                    // Handler
                    tabs.forEach(_tab => {
                        _tab.classList.remove('active-item')
                    });
                    tab.classList.add('active-item')

                    sections.forEach(section => {
                        section.style.display = 'none'
                    });
                    sections[i].style.display = 'flex'
                })
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
