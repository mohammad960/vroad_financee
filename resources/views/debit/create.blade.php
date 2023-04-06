 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<div id="wrapper">
  <center><h1> Insert New Debit</h1></center>
  
  
  <form id="quiz" action="{{route('debit.store')}}" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}
    <!-- Question 1 -->
    <h2>Select Store?</h2>
	<select  name="market_id">
	   
@foreach ($markets as $e)
    <option  value="{{$e->id}}" >{{$e->name}}</option>
@endforeach
</select>
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
</br>
    <table  style="width:100%">
	   <tr>
	   <th>Amount</th>
	   <th>Credit</th>
		<th>Time</th>
		</tr>
	   <tr>
	   <td>	<input  type="number" step="0.00000000000001" name="amount" placeholder="Enter Balance......." value="" required></td>
	    <td><input type="checkbox"  name="type"  class="largerCheckbox"/></td>
	
	   <td><input type="datetime-local" name="time" id="time" placeholder="Enter Time......." value="" required></td>
	 
	   </tr>
	   </table>
	   </br>
      <table  style="width:100%">
	   <tr>
	  
	     <th>Debetor</th>
	    <th>Note</th>
	 <th>Image</th>
		</tr>
	   <tr>
		<td>	<input type="text"  name="debtor" placeholder="Enter ......." value="" required></td>
	   <td>	<input type="text"  name="note" placeholder="Enter ......." ></td>

	  <td> <input type="file" name="image" class="form-control"></td>
	   </tr>
	   </table>

   


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
<script>
document.getElementById("time").defaultValue = new Date().toISOString().substring(0, 21);
</script>
<script src="/js/qz.js">

</script> 