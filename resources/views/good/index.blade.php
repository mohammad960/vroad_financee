<div id="wrapper">
  <center><h1> Update Inventory Stores</h1></center>
  
  
  <form id="quiz" action="{{route('good.store')}}" method="POST" enctype="multipart/form-data">
     
   {{ csrf_field() }}
    <!-- Question 1 -->
    <h2>Select Store?</h2>
	<select  name="market_id">
	   
@foreach ($markets as $e)
    <option  value="{{$e->id}}" >{{$e->name}}</option>
@endforeach
</select>
</br>
     <table  style="width:100%">
	   <tr>
	  
	     <th>Amount</th>
	    <th>Time</th>
	<th>Image</th>
		</tr>
	   <tr>
		<td><input  type="number" step="0.00000000000001" name="amount" placeholder="Enter ......." value="" required></td>
	   <td><input type="datetime-local" name="time"  id="time" placeholder="Enter ......." value="" required></td>
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
<script>
document.getElementById("time").defaultValue = new Date().toISOString().substring(0, 21);
</script>
<link href="/css/qz.css" rel="stylesheet" type="text/css">
<script src="/js/qz.js"></script> 