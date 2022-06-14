@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right; margin-right:2px" type="button" id="btnAddBranch" data-toggle="modal" data-target="#newbranch" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<button class="btn btn-primary bp" style="float: right" type="button" id="btnImportEmployee" data-toggle="modal" data-target="" data-backdrop="static" data-keyboard="false" >IMPORT</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>EMPLOYEE LIST</strong></h3>
<table id="branchTable" class="table branchTable table-hover display" style="cursor: pointer; width: 100%; font-size: 14px;">
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
            <th style="color:white">BRANCH ADDRESS</th>
            <th style="color:white">REGION</th>
            <th style="color:white">STATUS</th>
        </tr>
    </thead>

</table>
{{-- @include('branch.newbranch') --}}
@endsection