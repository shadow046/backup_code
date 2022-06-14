@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <button class="btn btn-primary bp" style="float: right" type="button" id="btnAddUser" data-toggle="modal" data-target="#newuser" data-backdrop="static" data-keyboard="false" >ADD USER</button>
    <h3 class="text-center"><strong>USER ACCOUNTS</strong></h3>
    <table id="userTable" class="table userTable display" >
        {{-- <table id="userTable" class="table userTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;"> --}}
        <thead>
            {{-- <thead style="background-color: #0d1a80; color: white; font-size: 15px;"> --}}
            <tr>
                <th>ID</th>
                <th>FULLNAME</th>
                <th>EMAIL</th>
                {{-- <th>USER LEVEL</th> --}}
                {{-- <th>STATUS</th> --}}
            </tr>
        </thead>
    </table>
</div>
@include('user.newuser')
@endsection