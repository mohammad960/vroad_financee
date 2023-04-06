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
   <a href="/"> <div id="last" style="color:white;" > <i style="transform: rotate(180deg);margin: 0 3px;color:white;" class="fa fa-sign-in" aria-hidden="true"></i>   Back To Dashboard</div> </a> </div>
        </div>
       
    </header>

    <main class="main-container" >
        <section id="Income" >
		 <form id="quiz" action="{{route('workB')}}" method="POST">
		      {{ csrf_field() }}
               <div id="dialog-data" >
                <label id=_1 class="my-3" >Select Option ?</label>
                <select class="form-select rounded-5 my-3" name="state" aria-label="Default select example">
                  
                    <option value="start">Start</option>
                    <option value="end">End</option>
             
                    </select>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Select Employee?</label>
                    <select class="form-select rounded-5 my-3" name="employee_id" aria-label="Default select example">
                        @foreach ($employee as $e)
                        <option value="{{$e->id}}">{{$e->full_name}}</option>
                     @endforeach
                    </select>
               </div>
 
               
               <div id="dialog-data" >
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="note" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Notes</label>
                  </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="date"  class="form-control my-3" placeholder="mm/dd/yyy" name="date" autocomplete="off">
                        </div>
                 
                </div>
               <center> <button>Send</button></center>
                 </form>
            </section>
            
    </main>
    <script>
	 document.getElementById("date").defaultValue = new Date().toISOString().substring(0, 21);
        window.onload = () => {
            var tabs = document.querySelectorAll('.list-item');
            var sections = document.querySelectorAll('section');
            var attaches = document.querySelectorAll('#attach');

            attaches.forEach(attach => {
                attach.addEventListener('click', function(){
                    attach.firstElementChild.click();
                })
            });

            tabs.forEach((tab,i) => {
                tab.addEventListener('click', function(){
                    // Handler
                    tabs.forEach(_tab => {
                        _tab.classList.remove('active-item')
                    });
                    tab.classList.add('active-item')
                    
                    sections.forEach(section => {
                        section.style.display = 'none'
                    });
                    sections[i].style.display = 'flex'
                })
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>