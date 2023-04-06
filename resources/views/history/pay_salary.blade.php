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
            <a href="/"> <div id="last" style="color:white;" > <i style="transform: rotate(180deg);margin: 0 3px;color:white;" class="fa fa-sign-in" aria-hidden="true"></i>   Back To Dashboard</div> </a> </div>
        </div>

    </header>

    <main class="main-container" >

        <section id="Salary" >
             <form  action="{{route('salary')}}"id="quiz"  onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
		  {{ csrf_field() }}
            <div id="dialog-data" >
                <label id=_1 class="my-3" >Pay Salary For {{$employee->full_name}}</label>
                </br>
				  <label id="normal-label" class="my-3" >From :</label>
                   <div class="form-label-group">
                            <input type="datetime-local" id="from_time"  class="form-control my-3"  placeholder="mm/dd/yyy" name="start_date" autocomplete="off">
                     </div>
					   <label id="normal-label" class="my-3" >To</label>
                      <div class="form-label-group">
                            <input type="datetime-local" id="to_time"  class="form-control my-3"  placeholder="mm/dd/yyy" name="end_date" autocomplete="off">
                       </div>

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


                {{-- <label id="normal-label" class="my-3" >Select Store ?</label>
                <select class="form-select rounded-5 my-3" aria-label="Default select example" required name="market_id" id="store">
                      @foreach ($stores as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>

                    @endforeach

                        </select> --}}




                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Salary</label>
                    <div class="form-floating mb-3">
                        <input type="numner" step="0.0001" class="form-control rounded-5" id="amount" value="{{$amount}}" required name="amount" placeholder="name@example.com">
                        <label for="floatingInput">Salary</label>
						<input type="text" name="employee_id" id="employee_id" hidden value="{{$employee->id}}" required />
                    </div>
                   <label id="normal-label" class="my-3" >Enter Bonous</label>
                     <div class="form-floating">
                        <input class="form-control my-4" placeholder="Leave a comment here" id="bonous" value="0" required name="bonous" />
                        <label for="floatingTextarea">Bonous</label>
                      </div>
					   <label id="normal-label" class="my-3" >Enter Method</label>
                     <div class="form-floating">
						  Cash:
						   <input class="form-control my-4" placeholder="Leave a comment here" value="0" id="cache" required name="cache" />
						Chec:
						<input class="form-control my-4" placeholder="Leave a comment here" value="0" id="chec" required name="chec" />
						Transfer:
						 <input class="form-control my-4" placeholder="Leave a comment here" value="0" id="transfer" required name="transfer" />

					</div>
					 <label id="normal-label" class="my-3" >Enter Note (Optional)</label>
					  <div class="form-floating">

                        <input class="form-control my-4" placeholder="Leave a comment here" value=""  name="note" />
                        <label for="floatingTextarea">Note</label>
                      </div>
                        <!-- DATE -->
                        <div class="form-label-group">
                            <input type="datetime-local" id="time_depit"  class="form-control my-3" required placeholder="mm/dd/yyy" name="time" autocomplete="off">
                            </div>

                </div>
                  <center>
				    <p id="error" style="color:red;"></p>
				  <button type="submit" id="submit">Send</button>
                  <button id="cancel" style="color:red;" name="cancel"  onclick="history.back()">Cancel</button>

				   </center>
        </form>
        </section>
		<div id="myModal" class="modal">
<center>
  <!-- Modal content -->
  <div id="dialog-data" >
    <span class="close">&times;</span>
    <p>Are you sure to cancel what you entered?</p>
  <button type="submit" id="submit" onclick="location.href = '/employee';" >Confirm</button>
  </center>
  </div>

</div>
    </main>
<script src="/js/qz.js"></script>
	<script>
function validateForm() {
  let cache = document.forms["quiz"]["cache"].value;
  let chec = document.forms["quiz"]["chec"].value;
  let transfer = document.forms["quiz"]["transfer"].value;
  let amount = document.forms["quiz"]["amount"].value;
  let bonous = document.forms["quiz"]["bonous"].value;
  let error = document.getElementById('error');;
  let side1=parseFloat(amount)+parseFloat(bonous);
  let side2=parseFloat(cache)+parseFloat(chec)+parseFloat(transfer);

  if (side1 != side2) {
	  error.textContent ="**** amount+bonous not equals (cache+check+transfer)";

    return false;
  }
}

 $("#to_time").on('change', function postinput(){
	  var startt = $("#from_time").val();
	  if(!startt){
		  alert("Please Enter Start Date");

	  }
	  else{
        var endt = $(this).val(); // this.value
		 var startt = $("#from_time").val();
		var id = $("#employee_id").val();
        $.ajax({
			dataType: "json",
            url: "{{'pay_ajax'}}",
            data: { "endt": endt,"start":startt,"id":id},
            type: 'get'
        }).done(function(responseData) {
            console.log('Done: ', responseData);
			$("#amount").val(responseData["amount"]);
        }).fail(function() {
            console.log('Failed');
        });
	  }
    });
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
