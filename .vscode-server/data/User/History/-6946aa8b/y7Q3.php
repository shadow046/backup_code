@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddUser" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>USER ACCOUNTS</strong></h3>
<table id="userTable" class="table userTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr>
            <th>ID</th>
            <th>FULLNAME</th>
            <th>EMAIL</th>
            <th>USER LEVEL</th>
            <th>STATUS</th>
            {{-- <th>STATUS</th> --}}
        </tr>
    </thead>
</table>
@include('user.newuser')
@endsection