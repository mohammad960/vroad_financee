@extends('adminlte::page')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>

@section('content')
<a class="btn btn-success" href="role/create" style="margin-left:80%;">Create User</a>
</br>
</br>
</br>
<table id="roleTable" class="table">
<thead>
<th scope="col" >rolename</th>

<th scope="col">Action</th>
</thead>
<tbody>
<?php
foreach($rol as $t){
	
	echo "<tr scope='row'>
<td>".$t->name."</td>

<td>
<a href='role/".$t->id."'>Show</a>
<a href='role/".$t->id."/edit'>Edit</a>
<a href='role/".$t->id."/destroy'>Delete</a>
</td>
</tr>";
}
?>

</tbody>
</table>

@endsection
	<script>
	$(document).ready(function() {
    $('#roleTable').DataTable();
} );
</script>	