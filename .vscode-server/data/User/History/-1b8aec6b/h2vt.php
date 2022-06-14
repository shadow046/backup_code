@extends('layouts.app')
@section('content')
<button class="btn btn-primary bp" style="float: right" type="button" id="btnAddBranch" data-toggle="modal" data-target="#newbranch" data-backdrop="static" data-keyboard="false" >ADD NEW</button>
<h3 class="text-center" style="color:#0d1a80;"><strong>BRANCH</strong></h3>
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
            <td>
                <input type="text" class="form-control filter-input fl-6" data-column="6" style="border:1px solid #808080"/>
            </td>
        </tr>
        <tr>
            <th style="color:white;">BRANCH CODE</th>
            <th>BRANCH NAME</th>
            <th>ADDRESS</th>
            <th>PROVINCE</th>
            <th>CITY</th>
            <th>REGION</th>
            <th>STATUS</th>
        </tr>
    </thead>

</table>
@include('branch.newbranch')
@endsection