<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
    font-size: 30px;
    font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-weight: bold;
    }
    .first_container{
        position: absolute;
        width: 1200px;
        height:1800px;
        margin: 50px;
        border: 3px solid black;
    }
    .header{
        position: relative;
        border: 2px solid black;
        height: 10%;
    }
    .separator{
        position: relative;
        /*margin:5%;*/
        border: 2px solid black;
        height: 3%;
        background-color: dimgrey;

    }
    .date{
        position: relative;
        border: 2px solid black;
        width:99.6%;
        height: 3%;
    }
    .fp{
        width:30%;
        border: 3px solid black;
        
    }
    .sp{
        width:40%;
        border: 3px solid black;
    }
    .ibody{
        height: 86%;
    }
    .toppart{
        border: 1px solid black;
        height: 10%;
        
    }
    .table1{
        position: relative;
        width:100%;
        height:100%;
        border-collapse: collapse;
        border: 1px solid black;
        margin:0;
        padding:0;
    }
    .table2{
        position: relative;
        width:100%;
        height:100%;
        border-collapse: collapse;
        border: 1px solid black;
        
    }
    .table3{
        position: relative;
        width:100%;
        height:100%;
        border-collapse: collapse;
        border: 1px solid black;
    }
    .sc{
        border: 1px solid black;
        width:30%;
        height:20%;
        margin:0;
        padding:0;
    }
    .bc{
        border: 1px solid black;
        width:40%;
        height:20%;
        margin:0;
        padding:0;
    }
    .topr1{
        position: relative;
        height:50%;
    }
    .topr2{
        position: relative;
        height:50%;
    }
    .middlepart{
        border: 1px solid black;
        height: 30%;
    }
    .bottompart{
        border: 1px solid black;
        height: 43%;
    }
    .middler{
        position: relative;
        height:14%;
    }
    .bottomr{
        position: relative;
        height:10%;
    }
    .mfp{
        width:43%;
        border: 3px solid black;
        
    }
    .msp{
        width:57%;
        border: 3px solid black;
    }
    .bfp{
        width:29.5%;
        
        
    }
    .bsp{
        width:69.5%;
        border: 3px solid black;
    }
    .fbfp{
        width:29.5%;
        border: 3px solid black;
        
    }
    .fbsp{
        width:69.5%;
        border: 3px solid black;
    }
    .lbfp{
        width:29.5%;
        border: 3px solid black;
        
    }
    .lbsp{
        width:69.5%;
        border: 3px solid black;
    }
	.money{
		color:green;
		font-size:30px;
		float:right;
	}
</style>
<body>
    <div class="first_container">

        <div class="table1" >
            <div class="header">
                   <div style="height:44%;"> header1</br>header2 </div> 
                    <hr style="width:25%; float: left;"></br>
                   <div style="transform: translateY(-10%);">header3</br>header4</div> 
            </div>
            <div class="date">
                <div style="height:100%;display:flex; direction: horizontal; align-items: center;">
                    <div style="width:43%; height: 100%;">Daily Report</div>
                    <div style="border-left:2px solid black; height: 100%;">Date:<span class="money">
							@isset($data['Date'])
										{{$data['Date']}}
							@endisset </span>
                </div>
                   </div> 
            </div>
            <div class="separator">
                    
            </div>
            <div class="toppart">
                    <table class="table2"  cellpadding="0" cellspacing="0">
                        <tr class="topr1"> 
                           <td class="fp">Cash: <span class="money">
							@isset($data['Cash In Hand yestarday'])
										{{$data['Cash In Hand yestarday']}}
							@endisset $</span></td>
                            <td class="fp">Cash: <span class="money">
							@isset($data['Cash In Hand'])
										{{$data['Cash In Hand']}}
							@endisset $</span></td>
							
                            <td class="sp">Deposit :<span class="money">
							@isset($data['Deposit'])
										{{$data['Deposit']}}
							@endisset $</span></td>
                        </tr>
                        <tr class="topr2">
                            <td class="fp">Checks</td>
                            <td class="fp">Checks</td>
                            <td class="sp">Drizly</td>
                        </tr>
                    </table>    
            </div>
            <div class="middlepart">
                    <table class="table3">
                        <tr class="middler"> 
                            <td class="mfp">Cash In Bank<span class="money"> </td>
                            <td class="msp">DOOR DASH :<span class="money">
							@isset($data['Door Dash'])
										{{$data['Door Dash']}}
							@endisset $</span></td>
							
                        </tr>
                        <tr class="middler">
                            <td class="mfp">Cash In Bank<span class="money"> </td>
                            <td class="msp">SAUSY :<span class="money">
							@isset($data['Sausy'])
										{{$data['Sausy']}}
								@endisset $</span></td> 
                        </tr>
                        <tr class="middler">
                            <td class="mfp">REDEPOSIT<span class="money">
							@isset($data['Order Bost'])
										{{$data['Order Bost']}}
								@endisset $</span></td> 
                            <td class="msp">LOTTO PAY OUT : <span class="money"> <span class="money">
							@isset($data['Lotto PO'])
										{{$data['Lotto PO']}}
								@endisset $</span></td>  
                        </tr>
                        <tr class="middler">
                            <td class="mfp">LOTTO : <span class="money"> <span class="money">
							@isset($data['Lotto'])
										{{$data['Lotto']}}
								@endisset $</span></td> 
                            <td class="msp">SCRATCH PAT OUT : <span class="money"> 
							@isset($data['Scratch PO'])
										{{$data['Scratch PO']}}
										@endisset $</span></td>
                        </tr>
                        <tr class="middler">
                            <td class="mfp">SCRATCH :<span class="money">@isset($data['Scratch Sold'])
										{{$data['Scratch Sold']}}
										@endisset $</span></td>  
                            <td class="msp">BIG ATM : <span class="money"> <span class="money">
							@isset($data['Big ATM'])
										{{$data['Big ATM']}}
								@endisset $</span></td> 
                        </tr>
                        <tr class="middler">
                            <td class="mfp">MONEY GRAM : <span class="money"> 
							@isset($data['Money Gram'])
										{{$data['Money Gram']}}
							@endisset $</span></td>
                            <td class="msp">ATM : <span class="money"> @isset($data['ATM'])
										{{$data['ATM']}}
							@endisset $</span></td>
                        </tr>
                        <tr class="middler">
                            <td class="mfp">MONEY ORDER : <span class="money"> 
							@isset($data['Money Order'])
										{{$data['Money Order']}}
							@endisset $</span></td>
                            <td class="msp">UPER EAT :<span class="money">@isset($data['Uber Eats'])
										{{$data['Uber Eats']}}
							@endisset $</span></td>  
                        </tr>
                    </table>   
            </div>
            <div class="bottompart">
                    <table class="table3">
                        <tr class="bottomr"> 
                            <td class="fbfp">
                              <div style="border-bottom: 1px solid black;">Z1</div>  
                              <div style="border-top: 1px solid black;"> NET SALE : <span class="money"> @isset($data['Net Sales'])
										{{$data['Net Sales']}}
							@endisset $</span></td>  
                            
                            <td class="fbsp">PAY OUT CASH NO TAX : <span class="money">@isset($data['Expence0'])
										{{$data['Expence0']}}
							@endisset $</span></td>  
                            
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                            <td class="bsp">PAY OUT CASH TAX :<span class="money"> @isset($data['Expence'])
										{{$data['Expence']}}
							@endisset $</span></td>  
                            
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                             <td class="bsp">PAY OUT CASH TAX1<span class="money">$</span> </td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                             <td class="bsp">PAY OUT CHECK NO TAX<span class="money"> $</span></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                          <td class="bsp">PAY OUT CHECK  TAX<span class="money"> $</span></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                            <td class="bsp"></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                            <td class="bsp"></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp"></td>
                            <td class="bsp"></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="bfp">
                                <div style="border-bottom: 1px solid black;"> <span style="visibility: hidden;">.</span></div>  
                                <div style="border-top: 1px solid black;"> Total in: <span class="money">{{$data['total_in']}} $</span> </div> 
                            </td>
                            <td class="bsp"></td>
                        </tr>
                        <tr class="bottomr"> 
                            <td class="lbfp">
                                <div style="border-bottom: 1px solid black;">Total out: <span class="money">{{$data['total_out']}} $</span></div>  
                              <div style="border-top: 1px solid black;"> Balance: <span class="money">{{$data['balance']}} $</span></div> 
                            </td>
                            <td class="lbsp">Cash</td>
                        </tr>
                    </table>   
            </div>

        </div>

    </div>
</body>
</html>