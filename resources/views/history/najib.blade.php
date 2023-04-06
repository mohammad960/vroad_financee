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
    <title>Finance - Home</title>
</head>
<body style="background: #f3f3f3;">

    <header style="background: url(../../img/login_bg.png);" >
        <div id="top" >
            <div id="first" >Financial Entry</div>
            <div id="last" ><i style="transform: rotate(180deg);margin: 0 3px;" class="fa fa-sign-in" aria-hidden="true"></i>
                 Back To Dashboard </div>
        </div>
        <nav>
            <div id="list" >
                <div class="list-container">
                    <span class="list-item active-item">Income</span>
                    <span class="list-item">Expense</span>
                    <span class="list-item">Salary</span>
                    <span class="list-item">Depit</span>
                    <span class="list-item">Inventory</span>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-container" >
	  <form id="quiz" action="{{route('answareA')}}" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}
        <section id="Income" >
               <div id="dialog-data" >
                <label id=_1 class="my-3" >What Type of Your Entry?</label>
                <select class="form-select rounded-5 my-3" aria-label="Default select example">
                    <option selected>Category Entry Type</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >What Type for Your Category Entry (Sub-Category)? </label>
                    <select class="form-select rounded-5 my-3" aria-label="Default select example">
                        <option selected>Sub-Category Entry Type</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
               </div>
               <!-- this need date -->
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Choose the Fund</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Fund 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Fund 2
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Invoice status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Chache
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Check
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Transfer
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Check INFO</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Number Check</label>
                    </div>
                    <!-- DATE FIELD  -->
                    <label for="inputCheckin">Date Check</label>
                    <input type="datetime-local" id="inputCheckin"  class="form-control mb-4" placeholder="Date Check" name="checkin1" autocomplete="off">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Person Who Take a check</label>
                    </div>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Amount</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-5" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Amount Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault25" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Debit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault25" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Credit
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Tax Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Tax
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Tax
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Declared Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Declared
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault4" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Declared
                        </label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Invoice Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault55" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            With Invoice
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault55" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Without Invoice
                        </label>
                    </div>
               </div>
               <!-- this need date -->
               <div id="dialog-data" >
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Notes</label>
                  </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="inputCheckin"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                        </div>
                    <div id='attach' style="cursor: pointer;" >
                        <input accept="image/*" type='file' id='file-inp' style="display: none;" />
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                    </div>
                </div>
                <button>Send</button>

            </section>
			</form>
            <section id="Expense"  style="display: none;" >
                <div id="dialog-data" >
                 <label id=_1 class="my-3" >What Type for Your Entry?</label>
                 <select class="form-select rounded-5 my-3" aria-label="Default select example">
                     <option selected>Category Entry Type</option>
                     <option value="1">One</option>
                     <option value="2">Two</option>
                     <option value="3">Three</option>
                     </select>
                 </div>
                 <div id="dialog-data" >
                     <label id="normal-label" class="my-3" >What Type for Your Category Entry (Sub-Category)?</label>
                     <select class="form-select rounded-5 my-3" aria-label="Default select example">
                         <option selected>Sub-Category Entry Type</option>
                         <option value="1">One</option>
                         <option value="2">Two</option>
                         <option value="3">Three</option>
                     </select>
                </div>
                <!-- this need date -->
                 <div id="dialog-data" >
                     <label id="normal-label" class="my-3" >Choose the Fund</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault9" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             Fund 1
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault9" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Fund 2
                         </label>
                     </div>
                     <label id="normal-label" class="my-3" >Choose Invoice status</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault8" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             Chache
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault8" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Check
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault8" id="flexRadioDefault3" checked>
                         <label class="form-check-label" for="flexRadioDefault3">
                             Transfer
                         </label>
                     </div>
                     <label id="normal-label" class="my-3" >Check INFO</label>
                     <div class="form-floating mb-3">
                         <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                         <label for="floatingInput">Number Check</label>
                     </div>
                     <!-- DATE FIELD  -->
                     <label for="inputCheckin">Date Check</label>
                     <input type="datetime-local" id="inputCheckin"  class="form-control mb-4" placeholder="Date Check" name="checkin1" autocomplete="off">
                     <div class="form-floating mb-3">
                         <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                         <label for="floatingInput">Person Who Take a check</label>
                     </div>
                 </div>
                 <div id="dialog-data" >
                     <label id="normal-label" class="my-3" >Enter Amount</label>
                     <div class="form-floating mb-3">
                         <input type="text" class="form-control rounded-5" id="floatingInput" placeholder="name@example.com">
                         <label for="floatingInput">Amount</label>
                     </div>
                     <label id="normal-label" class="my-3" >Choose Amount Status</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault110" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             Debit
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault110" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Credit
                         </label>
                     </div>
                     <label id="normal-label" class="my-3" >Choose Tax Status</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault13" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             With Tax
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault13" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Without Tax
                         </label>
                     </div>
                     <label id="normal-label" class="my-3" >Choose Declared Status</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault14" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             With Declared
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault14" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Without Declared
                         </label>
                     </div>
                     <label id="normal-label" class="my-3" >Choose Invoice Status</label>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault1">
                         <label class="form-check-label" for="flexRadioDefault1">
                             With Invoice
                         </label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="flexRadioDefault5" id="flexRadioDefault2" checked>
                         <label class="form-check-label" for="flexRadioDefault2">
                             Without Invoice
                         </label>
                     </div>
                </div>
                <!-- this need date -->
                <div id="dialog-data" >
                 <div class="form-floating">
                     <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                     <label for="floatingTextarea">Notes</label>
                   </div>
                     <!-- DATE -->
                     <div class="form-label-group">
                         <input type="datetime-local" id="inputCheckin"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                         </div>
                     <div id='attach' style="cursor: pointer;" >
                        <input type='file' id='file-inp1' accept="image/*" style="display: none;" />

                         <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                     </div>
                 </div>
                 <button>Send</button>
        </section>
        <section id="Salary"  style="display: none;" >
            Salary
        </section>
        <section id="Depit"  style="display: none;" >
            <div id="dialog-data" >
                <label id=_1 class="my-3" >Insert New Debit</label>
                <select class="form-select rounded-5 my-3" aria-label="Default select example">
                    <option selected>Select Store</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                    <label id="normal-label" class="my-3" >Choose the Fund</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Fund 1
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Fund 2
                        </label>
                    </div>
                </div>
                <div id="dialog-data" >
                    <label id="normal-label" class="my-3" >Enter Amount</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-5" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <label id="normal-label" class="my-3" >Choose Amount Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault110" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Debit
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault110" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Credit
                        </label>
                    </div>
                     <div class="form-floating">
                        <input class="form-control my-4" placeholder="Leave a comment here" id="floatingTextarea" />
                        <label for="floatingTextarea">Debetor</label>
                      </div>
                     <div class="form-floating">
                        <input class="form-control my-4" placeholder="Leave a comment here" id="floatingTextarea" />
                        <label for="floatingTextarea">Amount</label>
                      </div>
                        <!-- DATE -->
                        <div class="form-label-group">
                            <input type="datetime-local" id="inputCheckin"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                            </div>
                        <div id='attach' style="cursor: pointer;" >
                        <input type='file' id='file-inp2' accept="image/*" style="display: none;" />
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                        </div>
                </div>
                    <button>Send</button>
        </section>
        <section id="Inventory"  style="display: none;" >
            <div id="dialog-data" >
                <label id=_1 class="my-3" >Update Inventory Stores</label>
                <select class="form-select rounded-5 my-3" aria-label="Default select example">
                    <option selected>Select Store</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    </select>
                </div>
            <div id="dialog-data" >
                <div class="form-floating">
                    <input class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Amount</label>
                    </div>
                    <!-- DATE -->
                    <div class="form-label-group">
                        <input type="datetime-local" id="inputCheckin"  class="form-control my-3" placeholder="mm/dd/yyy" name="checkin" autocomplete="off">
                        </div>
                    <div id='attach' style="cursor: pointer;" >
                        <input type='file' accept="image/*" id='file-inp3' style="display: none;" />
                        <i class="fa fa-paperclip" aria-hidden="true"></i> Attach picture invoice
                    </div>
                </div>
            <button>Send</button>
        </section>
    </main>
    <script>
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
