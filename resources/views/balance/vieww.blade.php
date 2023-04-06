@extends('adminlte::page')

@section('content')

  <head>
<link  href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
<link  href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">

</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://unpkg.com/libphonenumber-js@^1.7.6/bundle/libphonenumber-min.js"></script>

	
<div class="container" style="background-color:#ffffff; max-width:1440px;">
 
   <!--div class="card" style="border-top:solid 3px blue;margin-top:1%;"-->
  <!--div class="card-header"-->
    
  <!-- /.card-tools -->
  <!--/div-->
  <!-- /.card-header -->
  <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="card-body" id="bill" style="background-color:#ffffff; width:100%;">

</br>
<center><B>Type Bill:</B> 
<select name="typeBill">
<option value="Quotation">Quotation</option>
<option value="Proforma Invoice">Proforma Invoice</option>
<option value="Commercial Invoice">Commercial Invoice</option>
</select>
	</center>
</br>	
<p><b>Goods Table: </b></p>
	
	<input type="text" value="{{$bill_information[0]->bill_id}}" name="bill_id" hidden>
 <div class="table-responsive">
<table class="table table-bordered table-striped" style="color:#3366ff; background-color:#ffffff;" id="table">

   <thead>
	  <th style="width:15%;">item</th>
	  <th style="width:20%;">Description</th>
	  <th style="width:5%;"> Quantity</th>
	  <th style="width:5%;">Price</th>
	  <th style="width:5%;">Total Amount</th>
	  <th style="width:5%;">Weight</th>
	  <th style="width:20%;" > Picture</th>
	  <th style="width:10%;">Carton, Pallet</th>
	  <th style="width:5%;">Warranty</th>
	  

   </thead>
  <tbody>
 
	@foreach($bill_information as $bi)
	<tr>
	   
	<td>{{ $bi->product_name_en }}({{ $bi->product_number }})</td>
	
	<td>{{ $bi->description_en }}</td>

	<td>{{ $bi->quant }}</td>
     @if ($bi->quant!=0)
	<td>{{ $bi->price/$bi->quant }}</td>
@else
	<td>0</td>
	@endif
	
	
	<td>{{ $bi->price }}</td>
	
	<td>{{ $bi->weight }}</td>
	<!--td><center><img src="{{ asset('assets/img/11.jpg') }}" style="width:60%;" class="img img-thumbnail" /></center></td-->
	<td><center><img src="https://www.marvel-battery.com/uploads/imagesUpload/{{ $bi->image }}" style="width:60%;" class="img img-thumbnail" /></center></td>
	
	<td></td>
	
	<td>{{ $bi->warranty }}</td>

	</tr>
	@endforeach
	   <!--tr>
	   <th>Download Bill as PDF</th>
	   
	   <th><a href="http://localhost:4000/uploads/pdfFile/" >Download</a></th>
	   </tr-->
		


  </tbody>
</table>
		<p><strong>Please fill Bill Information</strong></p>
			<div>
			
			
				<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="margin-left:5%;">PI DATE:</strong><input value="{{$request->pidate}}" type="date" required name="pidate" style="margin-left:1%; " >
					     </div>
				<hr style="background-color:black;">
				<strong style="margin-left:5%;">Buyer <span style="margin-left:45%;"> Ship to </span> </strong>
            </div>
		
			
			<div class="row">
			<div class="col-md-5">
			
			<table class="table table-bordered table-striped">
			
			<tbody>
			<tr>
				<td>Company name:</td>
				<td><input value="{{$request->comname1}}"type="text" required name="comname1"></td>
				
			</tr>
			<tr>
				<td>
				Address: <select name="countryCode" id="" style="width:50%;">
					<option value="{{$request->pino[10]}}{{$request->pino[11]}}"  Selected><?php echo explode("_",$request->address1)[0];?></option>
  <option value="AF">Afghanistan</option>
  <option value="AX">Åland Islands</option>
  <option value="AL">Albania</option>
  <option value="DZ">Algeria</option>
  <option value="AS">American Samoa</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AI">Anguilla</option>
  <option value="AQ">Antarctica</option>
  <option value="AG">Antigua and Barbuda</option>
  <option value="AR">Argentina</option>
  <option value="AM">Armenia</option>
  <option value="AW">Aruba</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria</option>
  <option value="AZ">Azerbaijan</option>
  <option value="BS">Bahamas (the)</option>
  <option value="BH">Bahrain</option>
  <option value="BD">Bangladesh</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus</option>
  <option value="BE">Belgium</option>
  <option value="BZ">Belize</option>
  <option value="BJ">Benin</option>
  <option value="BM">Bermuda</option>
  <option value="BT">Bhutan</option>
  <option value="BO">Bolivia (Plurinational State of)</option>
  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
  <option value="BA">Bosnia and Herzegovina</option>
  <option value="BW">Botswana</option>
  <option value="BV">Bouvet Island</option>
  <option value="BR">Brazil</option>
  <option value="IO">British Indian Ocean Territory (the)</option>
  <option value="BN">Brunei Darussalam</option>
  <option value="BG">Bulgaria</option>
  <option value="BF">Burkina Faso</option>
  <option value="BI">Burundi</option>
  <option value="CV">Cabo Verde</option>
  <option value="KH">Cambodia</option>
  <option value="CM">Cameroon</option>
  <option value="CA">Canada</option>
  <option value="KY">Cayman Islands (the)</option>
  <option value="CF">Central African Republic (the)</option>
  <option value="TD">Chad</option>
  <option value="CL">Chile</option>
  <option value="CN">China</option>
  <option value="CX">Christmas Island</option>
  <option value="CC">Cocos (Keeling) Islands (the)</option>
  <option value="CO">Colombia</option>
  <option value="KM">Comoros (the)</option>
  <option value="CD">Congo (the Democratic Republic of the)</option>
  <option value="CG">Congo (the)</option>
  <option value="CK">Cook Islands (the)</option>
  <option value="CR">Costa Rica</option>
  <option value="HR">Croatia</option>
  <option value="CU">Cuba</option>
  <option value="CW">Curaçao</option>
  <option value="CY">Cyprus</option>
  <option value="CZ">Czechia</option>
  <option value="CI">Côte d'Ivoire</option>
  <option value="DK">Denmark</option>
  <option value="DJ">Djibouti</option>
  <option value="DM">Dominica</option>
  <option value="DO">Dominican Republic (the)</option>
  <option value="EC">Ecuador</option>
  <option value="EG">Egypt</option>
  <option value="SV">El Salvador</option>
  <option value="GQ">Equatorial Guinea</option>
  <option value="ER">Eritrea</option>
  <option value="EE">Estonia</option>
  <option value="SZ">Eswatini</option>
  <option value="ET">Ethiopia</option>
  <option value="FK">Falkland Islands (the) [Malvinas]</option>
  <option value="FO">Faroe Islands (the)</option>
  <option value="FJ">Fiji</option>
  <option value="FI">Finland</option>
  <option value="FR">France</option>
  <option value="GF">French Guiana</option>
  <option value="PF">French Polynesia</option>
  <option value="TF">French Southern Territories (the)</option>
  <option value="GA">Gabon</option>
  <option value="GM">Gambia (the)</option>
  <option value="GE">Georgia</option>
  <option value="DE">Germany</option>
  <option value="GH">Ghana</option>
  <option value="GI">Gibraltar</option>
  <option value="GR">Greece</option>
  <option value="GL">Greenland</option>
  <option value="GD">Grenada</option>
  <option value="GP">Guadeloupe</option>
  <option value="GU">Guam</option>
  <option value="GT">Guatemala</option>
  <option value="GG">Guernsey</option>
  <option value="GN">Guinea</option>
  <option value="GW">Guinea-Bissau</option>
  <option value="GY">Guyana</option>
  <option value="HT">Haiti</option>
  <option value="HM">Heard Island and McDonald Islands</option>
  <option value="VA">Holy See (the)</option>
  <option value="HN">Honduras</option>
  <option value="HK">Hong Kong</option>
  <option value="HU">Hungary</option>
  <option value="IS">Iceland</option>
  <option value="IN">India</option>
  <option value="ID">Indonesia</option>
  <option value="IR">Iran (Islamic Republic of)</option>
  <option value="IQ">Iraq</option>
  <option value="IE">Ireland</option>
  <option value="IM">Isle of Man</option>
  <option value="IL">Israel</option>
  <option value="IT">Italy</option>
  <option value="JM">Jamaica</option>
  <option value="JP">Japan</option>
  <option value="JE">Jersey</option>
  <option value="JO">Jordan</option>
  <option value="KZ">Kazakhstan</option>
  <option value="KE">Kenya</option>
  <option value="KI">Kiribati</option>
  <option value="KP">Korea (the Democratic People's Republic of)</option>
  <option value="KR">Korea (the Republic of)</option>
  <option value="KW">Kuwait</option>
  <option value="KG">Kyrgyzstan</option>
  <option value="LA">Lao People's Democratic Republic (the)</option>
  <option value="LV">Latvia</option>
  <option value="LB">Lebanon</option>
  <option value="LS">Lesotho</option>
  <option value="LR">Liberia</option>
  <option value="LY">Libya</option>
  <option value="LI">Liechtenstein</option>
  <option value="LT">Lithuania</option>
  <option value="LU">Luxembourg</option>
  <option value="MO">Macao</option>
  <option value="MG">Madagascar</option>
  <option value="MW">Malawi</option>
  <option value="MY">Malaysia</option>
  <option value="MV">Maldives</option>
  <option value="ML">Mali</option>
  <option value="MT">Malta</option>
  <option value="MH">Marshall Islands (the)</option>
  <option value="MQ">Martinique</option>
  <option value="MR">Mauritania</option>
  <option value="MU">Mauritius</option>
  <option value="YT">Mayotte</option>
  <option value="MX">Mexico</option>
  <option value="FM">Micronesia (Federated States of)</option>
  <option value="MD">Moldova (the Republic of)</option>
  <option value="MC">Monaco</option>
  <option value="MN">Mongolia</option>
  <option value="ME">Montenegro</option>
  <option value="MS">Montserrat</option>
  <option value="MA">Morocco</option>
  <option value="MZ">Mozambique</option>
  <option value="MM">Myanmar</option>
  <option value="NA">Namibia</option>
  <option value="NR">Nauru</option>
  <option value="NP">Nepal</option>
  <option value="NL">Netherlands (the)</option>
  <option value="NC">New Caledonia</option>
  <option value="NZ">New Zealand</option>
  <option value="NI">Nicaragua</option>
  <option value="NE">Niger (the)</option>
  <option value="NG">Nigeria</option>
  <option value="NU">Niue</option>
  <option value="NF">Norfolk Island</option>
  <option value="MP">Northern Mariana Islands (the)</option>
  <option value="NO">Norway</option>
  <option value="OM">Oman</option>
  <option value="PK">Pakistan</option>
  <option value="PW">Palau</option>
  <option value="PS">Palestine, State of</option>
  <option value="PA">Panama</option>
  <option value="PG">Papua New Guinea</option>
  <option value="PY">Paraguay</option>
  <option value="PE">Peru</option>
  <option value="PH">Philippines (the)</option>
  <option value="PN">Pitcairn</option>
  <option value="PL">Poland</option>
  <option value="PT">Portugal</option>
  <option value="PR">Puerto Rico</option>
  <option value="QA">Qatar</option>
  <option value="MK">Republic of North Macedonia</option>
  <option value="RO">Romania</option>
  <option value="RU">Russian Federation (the)</option>
  <option value="RW">Rwanda</option>
  <option value="RE">Réunion</option>
  <option value="BL">Saint Barthélemy</option>
  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
  <option value="KN">Saint Kitts and Nevis</option>
  <option value="LC">Saint Lucia</option>
  <option value="MF">Saint Martin (French part)</option>
  <option value="PM">Saint Pierre and Miquelon</option>
  <option value="VC">Saint Vincent and the Grenadines</option>
  <option value="WS">Samoa</option>
  <option value="SM">San Marino</option>
  <option value="ST">Sao Tome and Principe</option>
  <option value="SA">Saudi Arabia</option>
  <option value="SN">Senegal</option>
  <option value="RS">Serbia</option>
  <option value="SC">Seychelles</option>
  <option value="SL">Sierra Leone</option>
  <option value="SG">Singapore</option>
  <option value="SX">Sint Maarten (Dutch part)</option>
  <option value="SK">Slovakia</option>
  <option value="SI">Slovenia</option>
  <option value="SB">Solomon Islands</option>
  <option value="SO">Somalia</option>
  <option value="ZA">South Africa</option>
  <option value="GS">South Georgia and the South Sandwich Islands</option>
  <option value="SS">South Sudan</option>
  <option value="ES">Spain</option>
  <option value="LK">Sri Lanka</option>
  <option value="SD">Sudan (the)</option>
  <option value="SR">Suriname</option>
  <option value="SJ">Svalbard and Jan Mayen</option>
  <option value="SE">Sweden</option>
  <option value="CH">Switzerland</option>
  <option value="SY">Syrian Arab Republic</option>
  <option value="TW">Taiwan (Province of China)</option>
  <option value="TJ">Tajikistan</option>
  <option value="TZ">Tanzania, United Republic of</option>
  <option value="TH">Thailand</option>
  <option value="TL">Timor-Leste</option>
  <option value="TG">Togo</option>
  <option value="TK">Tokelau</option>
  <option value="TO">Tonga</option>
  <option value="TT">Trinidad and Tobago</option>
  <option value="TN">Tunisia</option>
  <option value="TR">Turkey</option>
  <option value="TM">Turkmenistan</option>
  <option value="TC">Turks and Caicos Islands (the)</option>
  <option value="TV">Tuvalu</option>
  <option value="UG">Uganda</option>
  <option value="UA">Ukraine</option>
  <option value="AE">United Arab Emirates (the)</option>
  <option value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
  <option value="UM">United States Minor Outlying Islands (the)</option>
  <option value="US">United States of America (the)</option>
  <option value="UY">Uruguay</option>
  <option value="UZ">Uzbekistan</option>
  <option value="VU">Vanuatu</option>
  <option value="VE">Venezuela (Bolivarian Republic of)</option>
  <option value="VN">Viet Nam</option>
  <option value="VG">Virgin Islands (British)</option>
  <option value="VI">Virgin Islands (U.S.)</option>
  <option value="WF">Wallis and Futuna</option>
  <option value="EH">Western Sahara</option>
  <option value="YE">Yemen</option>
  <option value="ZM">Zambia</option>
  <option value="ZW">Zimbabwe</option>
</select>	</td>
				<td><input value="<?php echo explode("_",$request->address1)[1];?>"type="text" required name="address1"></td>
				
			</tr>
			<tr>
				<td>Phone No:</td>
				<td><input value="{{$request->phone1}}"type="text" required name="phone1"></td>
				
			</tr>
			<tr>
				<td>Mobile No:</td>
				<td><input value="{{$request->mobil1}}"type="text" required name="mobil1"></td>
				
			</tr>
			<tr>
				<td>Email:</td>
				<td><input value="{{$request->email1}}"type="email" required name="email1"></td>
				
			</tr>
			
			<tr>
			<td>Shipping By:</td>
			<td>
				<select class="custom-select" required name="dest">       
					<option><b>Sea</b></option>
					<option><b>Air</b></option>
					<option><b>Land</b></option>       
				</select>
			</td>
			</tr>
			</tbody>
	</table>
	</div>
	<div class="col-md-5 offset-1">
	<table class="table table-bordered table-striped">
			
			<tbody>
			<tr>
				
				<td>Company name:</td>
				<td><input value="{{$request->comname2}}"type="text" required name="comname2"></td>
			</tr>
			<tr>
				
				<td>Address: 
				<select name="countryCode2" id="" style="width:50%;">
					<option value="{{$request->address2[0]}}{{$request->address2[1]}}"  Selected><?php echo explode("_",$request->address2)[1];?></option>
  <option value="AF">Afghanistan</option>
  <option value="AX">Åland Islands</option>
  <option value="AL">Albania</option>
  <option value="DZ">Algeria</option>
  <option value="AS">American Samoa</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AI">Anguilla</option>
  <option value="AQ">Antarctica</option>
  <option value="AG">Antigua and Barbuda</option>
  <option value="AR">Argentina</option>
  <option value="AM">Armenia</option>
  <option value="AW">Aruba</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria</option>
  <option value="AZ">Azerbaijan</option>
  <option value="BS">Bahamas (the)</option>
  <option value="BH">Bahrain</option>
  <option value="BD">Bangladesh</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus</option>
  <option value="BE">Belgium</option>
  <option value="BZ">Belize</option>
  <option value="BJ">Benin</option>
  <option value="BM">Bermuda</option>
  <option value="BT">Bhutan</option>
  <option value="BO">Bolivia (Plurinational State of)</option>
  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
  <option value="BA">Bosnia and Herzegovina</option>
  <option value="BW">Botswana</option>
  <option value="BV">Bouvet Island</option>
  <option value="BR">Brazil</option>
  <option value="IO">British Indian Ocean Territory (the)</option>
  <option value="BN">Brunei Darussalam</option>
  <option value="BG">Bulgaria</option>
  <option value="BF">Burkina Faso</option>
  <option value="BI">Burundi</option>
  <option value="CV">Cabo Verde</option>
  <option value="KH">Cambodia</option>
  <option value="CM">Cameroon</option>
  <option value="CA">Canada</option>
  <option value="KY">Cayman Islands (the)</option>
  <option value="CF">Central African Republic (the)</option>
  <option value="TD">Chad</option>
  <option value="CL">Chile</option>
  <option value="CN">China</option>
  <option value="CX">Christmas Island</option>
  <option value="CC">Cocos (Keeling) Islands (the)</option>
  <option value="CO">Colombia</option>
  <option value="KM">Comoros (the)</option>
  <option value="CD">Congo (the Democratic Republic of the)</option>
  <option value="CG">Congo (the)</option>
  <option value="CK">Cook Islands (the)</option>
  <option value="CR">Costa Rica</option>
  <option value="HR">Croatia</option>
  <option value="CU">Cuba</option>
  <option value="CW">Curaçao</option>
  <option value="CY">Cyprus</option>
  <option value="CZ">Czechia</option>
  <option value="CI">Côte d'Ivoire</option>
  <option value="DK">Denmark</option>
  <option value="DJ">Djibouti</option>
  <option value="DM">Dominica</option>
  <option value="DO">Dominican Republic (the)</option>
  <option value="EC">Ecuador</option>
  <option value="EG">Egypt</option>
  <option value="SV">El Salvador</option>
  <option value="GQ">Equatorial Guinea</option>
  <option value="ER">Eritrea</option>
  <option value="EE">Estonia</option>
  <option value="SZ">Eswatini</option>
  <option value="ET">Ethiopia</option>
  <option value="FK">Falkland Islands (the) [Malvinas]</option>
  <option value="FO">Faroe Islands (the)</option>
  <option value="FJ">Fiji</option>
  <option value="FI">Finland</option>
  <option value="FR">France</option>
  <option value="GF">French Guiana</option>
  <option value="PF">French Polynesia</option>
  <option value="TF">French Southern Territories (the)</option>
  <option value="GA">Gabon</option>
  <option value="GM">Gambia (the)</option>
  <option value="GE">Georgia</option>
  <option value="DE">Germany</option>
  <option value="GH">Ghana</option>
  <option value="GI">Gibraltar</option>
  <option value="GR">Greece</option>
  <option value="GL">Greenland</option>
  <option value="GD">Grenada</option>
  <option value="GP">Guadeloupe</option>
  <option value="GU">Guam</option>
  <option value="GT">Guatemala</option>
  <option value="GG">Guernsey</option>
  <option value="GN">Guinea</option>
  <option value="GW">Guinea-Bissau</option>
  <option value="GY">Guyana</option>
  <option value="HT">Haiti</option>
  <option value="HM">Heard Island and McDonald Islands</option>
  <option value="VA">Holy See (the)</option>
  <option value="HN">Honduras</option>
  <option value="HK">Hong Kong</option>
  <option value="HU">Hungary</option>
  <option value="IS">Iceland</option>
  <option value="IN">India</option>
  <option value="ID">Indonesia</option>
  <option value="IR">Iran (Islamic Republic of)</option>
  <option value="IQ">Iraq</option>
  <option value="IE">Ireland</option>
  <option value="IM">Isle of Man</option>
  <option value="IL">Israel</option>
  <option value="IT">Italy</option>
  <option value="JM">Jamaica</option>
  <option value="JP">Japan</option>
  <option value="JE">Jersey</option>
  <option value="JO">Jordan</option>
  <option value="KZ">Kazakhstan</option>
  <option value="KE">Kenya</option>
  <option value="KI">Kiribati</option>
  <option value="KP">Korea (the Democratic People's Republic of)</option>
  <option value="KR">Korea (the Republic of)</option>
  <option value="KW">Kuwait</option>
  <option value="KG">Kyrgyzstan</option>
  <option value="LA">Lao People's Democratic Republic (the)</option>
  <option value="LV">Latvia</option>
  <option value="LB">Lebanon</option>
  <option value="LS">Lesotho</option>
  <option value="LR">Liberia</option>
  <option value="LY">Libya</option>
  <option value="LI">Liechtenstein</option>
  <option value="LT">Lithuania</option>
  <option value="LU">Luxembourg</option>
  <option value="MO">Macao</option>
  <option value="MG">Madagascar</option>
  <option value="MW">Malawi</option>
  <option value="MY">Malaysia</option>
  <option value="MV">Maldives</option>
  <option value="ML">Mali</option>
  <option value="MT">Malta</option>
  <option value="MH">Marshall Islands (the)</option>
  <option value="MQ">Martinique</option>
  <option value="MR">Mauritania</option>
  <option value="MU">Mauritius</option>
  <option value="YT">Mayotte</option>
  <option value="MX">Mexico</option>
  <option value="FM">Micronesia (Federated States of)</option>
  <option value="MD">Moldova (the Republic of)</option>
  <option value="MC">Monaco</option>
  <option value="MN">Mongolia</option>
  <option value="ME">Montenegro</option>
  <option value="MS">Montserrat</option>
  <option value="MA">Morocco</option>
  <option value="MZ">Mozambique</option>
  <option value="MM">Myanmar</option>
  <option value="NA">Namibia</option>
  <option value="NR">Nauru</option>
  <option value="NP">Nepal</option>
  <option value="NL">Netherlands (the)</option>
  <option value="NC">New Caledonia</option>
  <option value="NZ">New Zealand</option>
  <option value="NI">Nicaragua</option>
  <option value="NE">Niger (the)</option>
  <option value="NG">Nigeria</option>
  <option value="NU">Niue</option>
  <option value="NF">Norfolk Island</option>
  <option value="MP">Northern Mariana Islands (the)</option>
  <option value="NO">Norway</option>
  <option value="OM">Oman</option>
  <option value="PK">Pakistan</option>
  <option value="PW">Palau</option>
  <option value="PS">Palestine, State of</option>
  <option value="PA">Panama</option>
  <option value="PG">Papua New Guinea</option>
  <option value="PY">Paraguay</option>
  <option value="PE">Peru</option>
  <option value="PH">Philippines (the)</option>
  <option value="PN">Pitcairn</option>
  <option value="PL">Poland</option>
  <option value="PT">Portugal</option>
  <option value="PR">Puerto Rico</option>
  <option value="QA">Qatar</option>
  <option value="MK">Republic of North Macedonia</option>
  <option value="RO">Romania</option>
  <option value="RU">Russian Federation (the)</option>
  <option value="RW">Rwanda</option>
  <option value="RE">Réunion</option>
  <option value="BL">Saint Barthélemy</option>
  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
  <option value="KN">Saint Kitts and Nevis</option>
  <option value="LC">Saint Lucia</option>
  <option value="MF">Saint Martin (French part)</option>
  <option value="PM">Saint Pierre and Miquelon</option>
  <option value="VC">Saint Vincent and the Grenadines</option>
  <option value="WS">Samoa</option>
  <option value="SM">San Marino</option>
  <option value="ST">Sao Tome and Principe</option>
  <option value="SA">Saudi Arabia</option>
  <option value="SN">Senegal</option>
  <option value="RS">Serbia</option>
  <option value="SC">Seychelles</option>
  <option value="SL">Sierra Leone</option>
  <option value="SG">Singapore</option>
  <option value="SX">Sint Maarten (Dutch part)</option>
  <option value="SK">Slovakia</option>
  <option value="SI">Slovenia</option>
  <option value="SB">Solomon Islands</option>
  <option value="SO">Somalia</option>
  <option value="ZA">South Africa</option>
  <option value="GS">South Georgia and the South Sandwich Islands</option>
  <option value="SS">South Sudan</option>
  <option value="ES">Spain</option>
  <option value="LK">Sri Lanka</option>
  <option value="SD">Sudan (the)</option>
  <option value="SR">Suriname</option>
  <option value="SJ">Svalbard and Jan Mayen</option>
  <option value="SE">Sweden</option>
  <option value="CH">Switzerland</option>
  <option value="SY">Syrian Arab Republic</option>
  <option value="TW">Taiwan (Province of China)</option>
  <option value="TJ">Tajikistan</option>
  <option value="TZ">Tanzania, United Republic of</option>
  <option value="TH">Thailand</option>
  <option value="TL">Timor-Leste</option>
  <option value="TG">Togo</option>
  <option value="TK">Tokelau</option>
  <option value="TO">Tonga</option>
  <option value="TT">Trinidad and Tobago</option>
  <option value="TN">Tunisia</option>
  <option value="TR">Turkey</option>
  <option value="TM">Turkmenistan</option>
  <option value="TC">Turks and Caicos Islands (the)</option>
  <option value="TV">Tuvalu</option>
  <option value="UG">Uganda</option>
  <option value="UA">Ukraine</option>
  <option value="AE">United Arab Emirates (the)</option>
  <option value="GB">United Kingdom of Great Britain and Northern Ireland (the)</option>
  <option value="UM">United States Minor Outlying Islands (the)</option>
  <option value="US">United States of America (the)</option>
  <option value="UY">Uruguay</option>
  <option value="UZ">Uzbekistan</option>
  <option value="VU">Vanuatu</option>
  <option value="VE">Venezuela (Bolivarian Republic of)</option>
  <option value="VN">Viet Nam</option>
  <option value="VG">Virgin Islands (British)</option>
  <option value="VI">Virgin Islands (U.S.)</option>
  <option value="WF">Wallis and Futuna</option>
  <option value="EH">Western Sahara</option>
  <option value="YE">Yemen</option>
  <option value="ZM">Zambia</option>
  <option value="ZW">Zimbabwe</option>
</select>	
				</td>
				<td><input value="<?php echo explode("_",$request->address2)[2];?>" type="text" required name="address2"></td>
			</tr>
			<tr>
				
				<td>Phone No:</td>
				<td><input value="{{$request->phone2}}"type="text" required name="phone2"></td>
			</tr>
			<tr>
				
				<td>Mobile No:</td>
				<td><input value="{{$request->mobil2}}"type="text" required name="mobil2"></td>
			</tr>
			<tr>
				
				<td>Email:</strong></td>
				<td><input value="{{$request->email2}}"type="email" required name="email2"></td>
			</tr>
			
			</tbody>
	</table>
	</div>
	</div>
	</br>
		
		<div class="table-responsive">
			<table class="table table-bordered table-striped" style="color:#3366ff; background-color:#ffffff;">
		
			<tbody>

			<tr>
  			<td>Delivery Time</td>
			<td><input value="{{$request->deliverytime}}"type="text" required name="deliverytime"></td>
			<td></td>
			<td>Port of Loading</td>
			<td><input value="{{$request->loading}}"type="text" required name="loading"></td>
			</tr>

			<tr>
			<td>Country of origin of Goods</td>
			<td><input value="{{$request->originc}}"type="text" required name="originc"></td>
			<td></td>
			<td>Final Destination</td>
			<td><input value="{{$request->fdest}}"type="text" required name="fdest"></td>
			</tr>

			<tr>
			<td>Port of Discharge</td>
			<td><input value="{{$request->discharge}}"type="text" required name="discharge"></td>
			
			</tr>

			</tbody>
			</table>
		</div>
			</br>
	
		

	
	
	<h3> Payment Terms </h3>
	<table>
		<tbody>
			<tr>
			<td>
			<select class="custom-select" id="dep_bal">       
					<option id="op1">Deposit</option>
					<option> Balance Against B/L</option>
			</select>
			</td>
			
			</tr>
			<tr>
			<td id="td1">
			</td>
			</tr>
		
			
		</tbody>
	</table>
		</br>
				<b>Payment Against Delivery: <input value="{{$request->paydel}}"type="text" required name="paydel" >
			</br></br>
				<b>Bank Information: 
				</br>
				<table class="table table-bordered table-striped">
					
					<tbody>
						<tr>
						<td>Account Holder Name: </td>
						<td><input value="{{$request->acchold}}"type="text" required name="acchold" ></td>
						<td></td>
						<td>Bank Name: </td>
						<td><input value="{{$request->bankname}}"type="text" required name="bankname" ></td>
						</tr>

						<tr>
						<td>Bank Institution Number: </td>
						<td><input value="{{$request->bankins}}"type="text" required name="bankins" ></td>
						<td></td>
						<td>Branch / Transit Number: </td>
						<td><input value="{{$request->branchnum}}"type="text" required name="branchnum" ></td>
						</tr>

						<tr>
						<td>Branch Address: </td>
						<td><input value="{{$request->branchad}}"type="address" required name="branchad" ></td>
						<td></td>
						<td>Branch Phone Number: </td>
						<td><input value="{{$request->branchph}}"type="text" required name="branchph" ></td>
						</tr>

						<tr>
						<td>Branch Fax Number: </td>
						<td><input value="{{$request->branchfx}}"type="text" required name="branchfx" ></td>
						<td></td>
						<td>Account Number: </td>
						<td><input value="{{$request->accnum}}"type="text" required name="accnum" ></td>
						</tr>

						<tr>
						<td>Bank Swift Code: </td>
						<td><input value="{{$request->banksw}}"type="text" required name="banksw" ></td>
						<td></td>
						<td>Bank ABA / Routing Number: </td>
						<td><input value="{{$request->bankrn}}"type="text" required name="bankrn" ></td>
						</tr>

					</tbody>
				</table>
				
			<p> Notes: </p>
			<input value="{{$request->note}}" type="richtext" name="note" style="width:35%; height:60px;">

</br>
</br>
    
   
 </div>
  </div>

  <!-- /.card-body -->
</div>
		<div style="width:28%;">
		  Note: Please Confirm your Inputs before submitting
		</div>
		</br>
		<div id="btns">
            <a class="btn btn-primary" style="background-color: #4CAF50;border: 2px solid #4CAF50;" href="{{ route('bills.index') }}"> Back</a>
			<button type="submit" class="btn btn-primary" event="{{ route('pdf.store')}}">View Bill</button>
		
			
        </div>
        </div>
		
		</br>
</form>
</div>
<script type="text/javascript">

    const countries = libphonenumber.getCountries();
    const optionList = countries.map( country => "<option>${country}</option>" );
    $(".select-country").html( optionList );


</script>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>
	var td1 = $("#td1")[0];
	var selected = $("#op1").text();
	td1.innerHTML="Deposit: <input type='text' value='{{$request->deposit}}' required name='deposit'/><input value='{{$request->balbl}}' type='text' required name='balbl' hidden/>";
	$("#dep_bal").change(function () {
		selected = $(this).find("option:selected").text();
		if(selected=='Deposit')
		{
		td1.innerHTML="Deposit: <input value='0' type='text' value='{{$request->deposit}}' required name='deposit' /> <input value='{{$request->balbl}}' type='text' required name='balbl' hidden/>";
		}	
		else{
		td1.innerHTML="Balance Against B/L: <input value='{{$request->balbl}}' type='text' required name='balbl' /> <input value='0' type='text' value='{{$request->deposit}}' required name='deposit' hidden/> ";
		}
	});
</script>


@endsection 