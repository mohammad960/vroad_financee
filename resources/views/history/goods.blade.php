<div id="wrapper">
  <center><h1>New Cost Inventory</h1></center>
  
  
  <form id="quiz" action="{{route('goods')}}" method="POST">
   
   {{ csrf_field() }}
    <!-- Question 1 -->
    <h2></h2>
	<ul class="donate-now">
		@foreach ($employee as $e)
  <li>
    <input type="radio" id="{{$e->id}}" name="employee" value="{{$e->id}}" required />
	
    <label for="{{$e->id}}">{{$e->full_name}}</label>
  </li>
@endforeach  
</ul>
<br/>
<br/>
    <button type="submit" id="submit" >Go</button>
 <a  href="/history/create">Reset</a>
  </form>
  
</div>
<link href="/css/qz.css" rel="stylesheet" type="text/css">
<script src="/js/qz.js"></script> 