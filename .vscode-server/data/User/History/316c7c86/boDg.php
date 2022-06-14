@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h2 class="text-left;">Activity Logs</h2> --}}
    <br>
    <form action = "/create" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">
  
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
  
      <label class="form-group">First Name:</label>
      <input type="text" class="form-control" placeholder="First Name" name="first_name">
      <label>Last Name:</label>
      <input type="text" class="form-control" placeholder="Last Name" name="last_name">
    <label>City Name:</label>
    <select class="form-control" name="city_name">
      <option value="bhubaneswar">Bhubaneswar</option>
      <option value="cuttack">Cuttack</option>
    </select>
  <label>Email:</label>
      <input type="text" class="form-control" placeholder="Enter Email" name="email"><br>
      <button type="submit"  value = "Add student" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection