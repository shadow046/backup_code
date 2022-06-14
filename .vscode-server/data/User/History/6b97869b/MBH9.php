@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddShift" data-toggle="modal" data-target="#newshift" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>SHIFT MAINTENANCE</strong></h3>
<table id="shiftTable" class="table shiftTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80; color: white; font-size: 15px;">
        <tr>
            <th>SHIFT CODE</th>
            <th>START</th>
            <th>BREAK 1</th>
            <th>BREAK 2</th>
            <th>END</th>
            <th>TOTAL HOURS</th>
        </tr>
    </thead>
</table>
@include('shift.newshift')
@endsection