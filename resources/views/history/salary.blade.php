
<div id="wrapper">
  <center><h1>New Salary</h1></center>


  <form id="quiz" action="{{route('salary')}}" onsubmit="return validateForm()" method="POST">
   {{ csrf_field() }}
    <!-- Question 1 -->
	<div>
    <h2>He Works {{$hours}} hours and price hour is {{$price}}</h2>

	<label>Salary is:</label>
    <input type="text" id="amount" name="amount" value="{{$amount}}" required />
	<label>Bonous is:</label>
    <input type="text" id="bonous" name="bonous" value="0" required />
<input type="text" name="employee_id" hidden value="{{$employee}}" required />
<input type="text" name="start_time" hidden value="{{$start_time}}" required />
<input type="text" name="end_time" hidden value="{{$end_time}}" required />
</div>
<div>
    <h2>Select Box?</h2>
	<ul class="donate-now">
		@foreach ($box as $p)
  <li>
    <input type="radio" id="{{$p->id}}" name="box_id" value="{{$p->id}}" required />
    <label for="{{$p->id}}">{{$p->name}}</label>
  </li>
@endforeach
</ul>
</div>
<div>
 <h2>Method is:</h2>
      Cash:
    <input type="number" id="cache" name="cache" value="0"  />
	Chec:

    <input type="number" id="chec" name="chec" value="0"  />
	</br>
	Transfer:
    <input type="number" id="transfer" name="transfer" value="0"  />
</div>			<div>
		   <h2>Enter Note?</h2>
	<input type="text" style="width:40%;hight:30%;" name="note" placeholder="Enter Note......." value="" required>
  </div>
		<div>
		   <h2>Enter Time?</h2>
	<input type="datetime-local" style="width:40%;hight:30%;" name="time" placeholder="Enter Time......." value="" required>
  </div>
  <p id="error" style="color:red;"></p>
    <button type="submit" id="submit" >Finish</button>
<a   id="cancel"  style="color:red;">Cancel</a>
  </form>

</div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Are you sure to cancel what you entered?</p>
  <button type="submit" id="submit" onclick="location.href = '/history/create';" >Confirm</button>
  </div>

</div>
<link href="/css/qz.css" rel="stylesheet" type="text/css">
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
</script>
