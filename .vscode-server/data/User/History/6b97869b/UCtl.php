@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddShift" data-toggle="modal" data-target="#newshift" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;">SHIFT MAINTENANCE<strong></strong></h3>
<table id="shiftTable" class="table leaveTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr>
            <th>LEAVE CODE</th>
            <th>LEAVE TYPE</th>
            <th>NO.OF DAYS</th>
            <th>AVAILMENT MONTH</th>
        </tr>
    </thead>
</table>
@include('shift.newshift')
@endsection