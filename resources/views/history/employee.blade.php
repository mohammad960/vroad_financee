
<div id="wrapper">
  <center><h1>New Salary</h1></center>
  
  
  <form id="quiz" action="{{route('answareB')}}" method="POST">
    <input type="text"  name="A" value="{{$type}}S" hidden />
   {{ csrf_field() }}
    <!-- Question 1 -->
	 <input type="date"  name="start" />
	<input type="date"  name="endt" />
	<div>
    <h2>Who Employee?</h2>
	<ul class="donate-now">
		@foreach ($employee as $e)
  <li>
    <input type="radio" id="{{$e->id}}" name="employee" value="{{$e->id}}" required />
	
    <label for="{{$e->id}}">{{$e->full_name}}</label>
  </li>
@endforeach  
</ul>
</div>


    <button type="submit" id="submit" >Next</button>
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