@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddBranch" data-toggle="modal" data-target="#newbranch" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>BRANCH</strong></h3>
<table id="branchTable" class="table branchTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80;  font-size: 15px;">
        <tr>
            <td>BRANCH CODE</td>
            <td>BRANCH NAME</td>
            <td>ADDRESS</td>
            <td>PROVINCE</td>
            <td>CITY</td>
            <td>REGION</td>
            <td>STATUS</td>
        </tr>
        <tr>
            <th>BRANCH CODE</th>
            <th>BRANCH NAME</th>
            <th>ADDRESS</th>
            <th>PROVINCE</th>
            <th>CITY</th>
            <th>REGION</th>
            <th>STATUS</th>
        </tr>
    </thead>

</table>
<style>
thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    th{
        color:white
    }
    
</style>
@include('branch.newbranch')
@endsection