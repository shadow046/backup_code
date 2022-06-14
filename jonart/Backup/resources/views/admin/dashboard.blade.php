@extends('layouts.app')
@section('content')
    <div class="container">   
    <!-- DataTable -->
            <div class="panel-body">
               <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>CUSTOMER NAME</th>
                            <th>ITEM DESCRIPTION</th>
                            <th>SERIAL</th>
                            <th>START</th>
                            <th>END</th>
                            <th>SPECIFICATION</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($list as $item)                       
                        <tr>
                            <th>{{$item->Customer_name}}</th>
                            <th>{{$item->Item_description}}</th>
                            <th>{{$item->Serial}}</th>
                            <th>{{$item->Receiving_date}}</th>
                            <th>{{$item->End_warranty}}</th>
                            <th>{{$item->Specifications}}</th>
                            <th>{{$item->Status}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @endsection