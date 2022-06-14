@extends('layouts.app')
@section('content')
<div class="fade-in" role="dialog">
    <div class="container pt-5">   
        <div class="row">
            <div class="container-fluid">     
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                USERS<i class="fa fa-users" style="font-size:30px;float:right;line-height:20px;"></i>
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">
                                {{DB::table('admins')->count();}}               
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                CUSTOMERS<i class="fas fa-hourglass" style="font-size:30px;float:right;line-height:px;"></i>      
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">
                                {{DB::table('lccs')->count();}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="background-color: #0d1a80; color: white; font-size:100%;font-weight: bold">
                                EXPIRED<i class="fas fa-hourglass-end" style="font-size:30px;float:right;line-height:px;"></i>
                                WARRANTY/MA
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">
                                {{DB::table('lccs')
                                    ->where('End_warranty','>=',Carbon\Carbon::now()->toDayDateTimeString())->count();                               
                                }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>DATE AND TIME</th>
                    <th>EMAIL</th>
                    <th>NAME</th>
                    <th>ACTIVITY</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($list as $item)                       
                <tr>
                    <th>{{$item->DateAndTime}}</th>
                    <th>{{$item->Email}}</th>
                    <th>{{$item->Name}}</th>
                    <th>{{$item->Activity}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
    