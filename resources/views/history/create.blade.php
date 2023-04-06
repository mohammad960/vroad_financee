 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<div id="wrapper">
  <center><h1>New Entry</h1></center>
  
   @if ($message = Session::get('success'))
      <center>  <div id="not" style="width:40%;background-color:#03fc7f;border-radius: 100px;">
          <center>  <p>{{ $message }}</p></center>
        </div>
		</center>
     
		<script>
		setTimeout(function() {
			$('#not').fadeOut('fast');
			}, 3000); //
		</script>
    @endif
  <form id="quiz" action="{{route('answareA')}}" method="POST">
   {{ csrf_field() }}
    <!-- Question 1 -->
	<div>
    <h2>What Type for Your Entry?</h2>
	<ul class="donate-now">
		@foreach ($parents as $p)
  <li>
    <input type="radio" id="{{$p->id}}" name="A" value="{{$p->id}}" required />
  <label for="{{$p->id}}">{{$p->name}}</label>
  </li>
@endforeach  
</ul>
</div>
    <button type="submit" id="submit" >Next</button>
		
		  <a  href="/" id="home" style="color:red;float:left;">Back to Dashboard</a>
		
  </form>
  
</div>
<link href="/css/qz.css" rel="stylesheet" type="text/css">
<script src="/js/qz.js"></script> 