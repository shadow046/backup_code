@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddLeave" data-toggle="modal" data-target="#newleave" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;">Leave MAINTENACE<strong></strong></h3>
<table id="leaveTable" class="table holidayTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr>
            <th>LEAVE NAME</th>
            <th>NO.OF DAYS</th>
            <th>AVAILMENT MONTH</th>
            {{-- <th>STATUS</th> --}}
        </tr>
    </thead>
</table>
@include('holiday.newleave')
@endsection