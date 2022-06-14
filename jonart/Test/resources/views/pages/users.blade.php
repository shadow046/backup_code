@extends('layouts.app')
@section('content')
  
    <div class="container">
    <!-- DataTable -->
            <div class="panel-body">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success')}}
                    </div>
                @endif
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail')}}
                        {{ Session::get('fail')}}                      
                    </div>
                @endif
                      
               <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>FULL NAME</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>LEVEL</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($list as $item)                       
                        <tr>
                            <th>{{$item->name}}</th>
                            <th>{{$item->name}}</th>
                            <th>{{$item->email}}</th>
                            <th>{{$item->userlevel}}</th>
                            <th>{{$item->status}}</th>
                            <th class="text-center">
                                <a href="#" class="m-r-15 text-muted userEdit" data-toggle="modal" data-idUpdate="'.$row->id" data-target="#updateUser">
                                    <i class="fa fa-eye" style="color:#2196f3;"></i>                                
                                </a> <span> </span>
                                <a href="#" class="m-r-15 text-muted userEdit" data-toggle="modal" data-idUpdate="'.$row->id" data-target="#updateUser">
                                    <i class="fa fa-edit" style="color:#2196f3;"></i>                                
                                </a>                                                             
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table><br>
                <div class="pr-3">
                    <a href="#" data-toggle="modal" data-target="#createUser" class="fa fa-plus-square" style="font-size:12px;"> ADD NEW USER</a>
                    <!-- <a href="#" data-toggle="modal" data-target="#createUser">
                    <i class="fa fa-edit"></i>                    
                    </a> -->
                </div>
            </div>
    </div>

  @include('pages.updateuser');
  @include('pages.createuser');
  
@endsection
    