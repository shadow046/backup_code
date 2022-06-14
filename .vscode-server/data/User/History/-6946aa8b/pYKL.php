@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddUser" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>USER ACCOUNTS</strong></h3>
<table id="userTable" class="table userTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr class="tbsearch">
            <td>
                <input type="text" class="form-control filter-input fl-0" data-column="0" style="border:1px solid #808080"/>
            </td>
            <td>
                <input type="text" class="form-control filter-input fl-1" data-column="1" style="border:1px solid #808080"/>
            </td>
            <td>
                <input type="text" class="form-control filter-input fl-2" data-column="2" style="border:1px solid #808080"/>
            </td>
            <td>
                <input type="text" class="form-control filter-input fl-3" data-column="3" style="border:1px solid #808080"/>
            </td>
            <td>
                <input type="text" class="form-control filter-input fl-4" data-column="4" style="border:1px solid #808080"/>
            </td>
        </tr>
        <tr>
            <th>ID</th>
            <th>FULLNAME</th>
            <th>EMAIL</th>
            <th>USER LEVEL</th>
            <th>STATUS</th>
        </tr>
    </thead>
</table>
@include('user.newuser')
@endsection