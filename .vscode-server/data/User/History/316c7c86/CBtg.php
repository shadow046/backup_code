@extends('layouts.app')

@section('content')
<h1>HOME</h1> 
<?php

$name="user";

$address="jaipur";

$mark="100%";

$best="best";

?>

<table border="1px" cellpadding="4" cellspacing="50">

<tr>

<td>name</td>

<td>address</td>

<td>mark</td>

<td>best</td>

</tr>

<tr>

<?php

echo "<td>$name</td>";

echo "<td>$address</td>";

echo "<td>$mark</td>";

echo "<td>$best</td>";

?>

</tr>

</table>
@endsection