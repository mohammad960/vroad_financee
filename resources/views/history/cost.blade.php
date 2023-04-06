 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<div id="wrapper">
  <center><h1>New Entry</h1></center>


  <form id="quiz" action="{{route('answareC')}}" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data">
     {{ csrf_field() }}
    <!-- Question 1 -->
	<div>
    <h2>What Type for Your Category Entry?</h2>
	<ul class="donate-now">
		@foreach ($parents as $p)
  <li>
    <input type="radio" id="{{$p->id}}" name="A" value="{{$p->id}}" required />
    <label for="{{$p->id}}">{{$p->name}}</label>
  </li>
@endforeach
</ul>
</div>
	<div  id="category" style="display:none;">

    <h2>What Type for Your Category Entry (Sub-Category)?</h2>
	<ul class="donate-now" id="ulId">
		@foreach ($category as $p)
  <li>
    <input type="radio" id="{{$p->id}}" name="B" value="{{$p->id}}" required />
    <label for="{{$p->id}}">{{$p->name}}</label>
  </li>
@endforeach
</ul>
</div>
<div id="inputall"  style="display:none;">
<div>
		<h2>Fund</h2>
		<ul class="donate-now">
		@foreach ($box as $p)
		  <li>
			<input type="radio" id="{{$p->id}}" name="box_id" value="{{$p->id}}" required />
			<label for="{{$p->id}}">{{$p->name}}</label>
		  </li>
		@endforeach
		</ul>

	 <input type="text" name="type" hidden value="{{$type}}" required />
</div>
	<div>
		<div>

	<input type="number" step="0.00000000000001" style="width:40%;hight:30%;" name="amount" placeholder="Enter Balance......." value="" required>
	  	<div>
	<ul class="donate-now">

  <li>
    <input type="radio" id="cache" name="method" value="cache"  required />
    <label for="cache">Cash</label>
  </li>
    <li>
    <input type="radio" id="check" name="method" value="check" required  />
    <label for="check">check

	</label>

  </li>

    <li>
    <input type="radio" id="transfer" name="method"  onsubmit="return validateForm()" value="transfer" required />
    <label for="transfer">transfer</label>
  </li>

</ul>
</br>
</div>
		<div id="modalCheck" style="display:none;">
		     <table  style="width:100%">
			   <tr>
			   <th>Number Check</th>
				<th>Date Check</th>
				<th>Person Who Take a check</th>
				</tr>
			   <tr>
			   <td>	<input type="text" id="number_check" name="number_check" placeholder="Enter Number......."  ></td>
			   <td>	<input type="datetime-local"  id="date_check" name="date_check" placeholder="Enter Note......."></td>
			   <td> <input type="text" id="to_who" name="to_who" placeholder="Enter Name....."></td>

			   </tr>
			   </table>

	  </div>
</br>
	<table  style="width:100%">
	   <tr>
	   <th>With Tax</th>
	   <th>Without Tax</th>
	    <th>With Declared</th>
		<th>Without Declared</th>
		</tr>
	   <tr>
	   <td><input type="radio"  name="tax"  value="1" class="largerCheckbox"/></td>
	   <td><input type="radio"  name="tax"  value="0" class="largerCheckbox"/></td>
	   <td><input type="radio"   name="declared" value="1" class="largerCheckbox" /></td>
		<td><input type="radio"  name="declared" value="0" class="largerCheckbox"/></td>
	   </tr>
	   </table>
	     <table  style="width:100%">
	     <tr>
		 <th>Debit</th>
		  <th>Credit</th>
		  @if ($type != 3)
		  <th>With Innvoice</th>
			<th>Without Innvoice</th>
			@endif
		</tr>
	   <tr>
	   <td><input type="radio"  name="credit"  value="0" class="largerCheckbox" required /></td>
	 <td><input type="radio"   name="credit" value="1" class="largerCheckbox" required /></td>

	  @if ($type != 3)
	   <td><input type="radio"   name="innvoice"  value="0"  class="largerCheckbox "/></td>
     <td><input type="radio"   name="innvoice"  value="1"  class="largerCheckbox "/></td>
   @endif
	   </tr>
	   </table>
  </div>


	  </br>
	     <table  style="width:100%">
	   <tr>
	   <th>Note</th>
	    <th>Time</th>
		<th>Image</th>
		</tr>
	   <tr>
	   <td>	<input type="text" name="note" placeholder="Enter Note......." value="" ></td>
	   <td>	<input type="datetime-local"id="time" name="time" placeholder="Enter Time......." value="" required></td>
	   <td> <input type="file" name="image" class="form-control"></td>

	   </tr>
	   </table>

			  <p id="error" style="color:red;"></p>


</div>

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
 document.getElementById("time").defaultValue = new Date().toISOString().substring(0, 21);

$('input[type=radio][name=A]').change(function() {
	$('#category').css('display', 'block');
	$('#inputall').css('display', 'block');
		 $.ajax({
                url: '{{"child"}}', // sending ajax request to this server page
                type: 'get',
                dataType: "json",
                data: {
                   'parent': this.id                },
                success: function (response) {

					let div = '';
					response.forEach(myFunction);
					$("#ulId").html(div);
					function myFunction(item) {
					  div += " <li><input type='radio' id='"+item.id+"'"+ "name='B'" +"value='"+item.name+"' required /> <label for='"+item.id+"'>"+item.name+"</label></li>";

					}


					$("#ulId").html(div);
                }
             });
         event.preventDefault();

});
</script><script>

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
var radioState = [];

$(":radio").on('click', function(e) {
  //console.log(radioState[this.name])
  if (radioState[this.name] === this) {
    this.checked = false;
    radioState[this.name] = null;
  } else {
    radioState[this.name] = this;
  }
});
</script>
