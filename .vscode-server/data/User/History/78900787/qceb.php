@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddUser" data-toggle="modal" data-target="#newuser" data-backdrop="static" data-keyboard="false" >ADD USER</button>
<h3 class="text-center" style="color:#0d1a80;">HOLIDAY MAINTENACE<strong></strong></h3>
<table id="userTable" class="table userTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr>
            <th>ID</th>
            <th>FULLNAME</th>
            <th>EMAIL</th>
            <th>USER LEVEL</th>
            {{-- <th>STATUS</th> --}}
        </tr>
    </thead>
</table>
@include('holidat.newholiday')
@endsection