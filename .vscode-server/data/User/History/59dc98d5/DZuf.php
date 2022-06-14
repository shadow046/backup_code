@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right; " type="button" id="btnAddEmployee" data-toggle="modal" data-target="#newemployee" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<button class="btn btn-primary bp" style="float: right; margin-right:4px;" type="button" id="btnImportEmployee" data-toggle="modal" data-target="" data-backdrop="static" data-keyboard="false" >IMPORT</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>EMPLOYEE LIST</strong></h3>
<div class="control-group">
    <label class="control-label">Course</label>
    <div class="controls">
       <select name="course" id="course" style="width:220px;" selected disabled>
       <option @if($studentDetails->course=="ABE") selected @endif value="ABE">ABE</option>
       <option @if($studentDetails->course=="BEED") selected @endif value="BEED">BEED</option>
       <option @if($studentDetails->course=="BSED") selected @endif value="BSED">BSED</option>
       <option @if($studentDetails->course=="BSA") selected @endif value="BSA">BSA</option>
       </select>
    </div>
 </div>
<table id="employeeTable" class="table employeeTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
    <thead style="background-color: #0d1a80;  font-size: 15px;">
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
            <td>
                <input type="text" class="form-control filter-input fl-5" data-column="5" style="border:1px solid #808080"/>
            </td>
        </tr>
        <tr>
            <th style="color:white">EMPLOYEE NO.</th>
            <th style="color:white">EMPLOYEE NAME</th>
            <th style="color:white">BRANCH NAME</th>
            <th style="color:white">ADDRESS</th>
            <th style="color:white">POSITION</th>
            <th style="color:white">STATUS</th>
        </tr>
    </thead>

</table>
@include('employee.newemployee')
@include('employee.leavecredit')
@include('employee.approvinggroup')
@endsection