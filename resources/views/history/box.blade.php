<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div id="wrapper">
  <center><h1>New Cost</h1></center>


  <form id="quiz" action="{{route('answareC')}}" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}
    <!-- Question 1 -->
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
	<input type="text" hidden name="cost_id" value="{{$cost_id}}" required />
	 <input type="text" name="type" hidden value="{{$type}}" required />
</div>
	<div>
       <h2>Choose?</h2>
		<ul class="donate-now">
		  <li>
			<input type="radio"  id="tax1" name="tax" value="1" />
			<label for="tax1">With Tax</label>
		  </li>
			<li>
			<input type="radio"  id="tax2" name="tax" value="0" />
			<label for="tax2">Without Tax</label>
		  </li>
		   <li>
			<input type="radio"  id="tax3" name="tax" value="none" />
			<label for="tax3">None</label>
		  </li>
		</ul>
		</div>

			<div>
		<ul class="donate-now">
		  <li>
			<input type="radio"  id="declared1" name="declared" value="1" />
			<label for="declared1">Been Declared</label>
		  </li>
			<li>
			<input type="radio"  id="declared2" name="declared" value="0" />
			<label for="declared2">Not Been Declared</label>
		  </li>
		  <li>
			<input type="radio"  id="declared3" name="declared" value="none" />
			<label for="declared3">None</label>
		  </li>
		</ul>
		 	</div>
				<div>
		   <h2>Enter Amount?</h2>
	<input type="text" style="width:40%;hight:30%;" name="amount" placeholder="Enter Balance......." value="" required>
		<div>

		<ul class="donate-now">
		  <li>
			<input type="radio"  id="credit" name="credit" value="1" required />
			<label for="credit">Credit</label>
		  </li>
			<li>
			<input type="radio"  id="credit2" name="credit" value="0" required />
			<label for="credit2">Debit</label>
		  </li>
		</ul>

		 	</div>
  </div>
  	<div>

	 <h2>Method is:</h2>
	<ul class="donate-now">

  <li>
    <input type="radio" id="cache" name="method" value="cache"  />
    <label for="cache">Cash</label>
  </li>
    <li>
    <input type="radio" id="check" name="method" value="check"  />
    <label for="check">check

	</label>

  </li>

    <li>
    <input type="radio" id="transfer" name="method"  onsubmit="return validateForm()" value="transfer"  />
    <label for="transfer">transfer</label>
  </li>

</ul>
		</div>
		<div id="modalCheck" style="display:none;">
		   <h2>Enter Number Check?</h2>
		<input type="text" style="width:40%;hight:30%;" id="number_check" name="number_check" placeholder="Enter Number......."  >
			   <h2>Enter Date Check?</h2>
		<input type="datetime-local" style="width:40%;hight:30%;" id="date_check" name="date_check" placeholder="Enter Note.......">
		 <h2>Person Who Take a check?</h2>
		<input type="text" style="width:40%;hight:30%;" id="to_who" name="to_who" placeholder="Enter Name.....">
	  </div>
				<div>
		   <h2>Enter Note?</h2>
	<input type="text" style="width:40%;hight:30%;" name="note" placeholder="Enter Note......." value="" required>
  </div>
  			<div>
		   <h2>Enter Time?</h2>
	<input type="datetime-local" style="width:40%;hight:30%;" name="time" placeholder="Enter Time......." value="" required>
  </div>
  <div>
		   <h2>Enter Image?</h2>
     <input type="file" name="image" class="form-control">
   </div>
   	<div>
		<ul class="donate-now">
		  <li>
			<input type="radio"  id="innvoice1" name="innvoice" value="1" required />
			<label for="innvoice1">Innvoice</label>
		  </li>
			<li>
			<input type="radio"  id="innvoice" name="innvoice" value="0" required />
			<label for="innvoice">No Innvoice</label>
		  </li>

		</ul>
		 	</div>
			  <p id="error" style="color:red;"></p>
    <button type="submit" id="submit" >Finish</button>
 <a   id="cancel" style="color:red;">Cancel</a>



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

var modalCheck = document.getElementById("modalCheck");


var method = document.getElementById("check");
var cache = document.getElementById("cache");
var transfer = document.getElementById("transfer");
method.onclick = function() {
  modalCheck.style.display = "block";
}


cache.onclick = function() {
  modalCheck.style.display = "none";
}
transfer.onclick = function() {
  modalCheck.style.display = "none";
}

</script>

