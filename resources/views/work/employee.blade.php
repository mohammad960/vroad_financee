<div id="wrapper">
  <center><h1>Work Time</h1></center>
  
  
  <form id="quiz" action="{{route('workB')}}" method="POST">
   {{ csrf_field() }}
    <!-- Question 1 -->
    <h2>Select Employee?</h2>
	<select  name="employee_id">
@foreach ($employee as $e)
    <label><option  value="{{$e->id}}" >{{$e->full_name}}</option>
	
    </label><br />
@endforeach
</select>
    </label><br />
	 <h2>Select Time?</h2>
<input type="datetime-local" name="date" required />
<input type="text" value="{{$state}}" hidden name="state"/>
</label><br />
    <button type="submit" id="submit" >Finish</button>
 <a  href="/work">Reset</a>
  </form>
  
</div>
<link href="/css/qz.css" rel="stylesheet" type="text/css">
<script src="/js/qz.js"></script> 