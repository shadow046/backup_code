<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!auth()->user()->hasanyRole('admin')) //---ROLES---//
        {
            return redirect('/');
        }
        // $holiday = HolidayType::query()->select()->get()->sortBy('name');
        //return view('leave.leave', compact('leave'));
        return view('leave.leave');
    }
    public function leaveTable(){
        // $list = Holiday::select('id','name','type','remarks','date')->get();
        // return DataTables::of($list)->make(true);

        $list = Leave::select('leave.code', 'leave.type', 'leave.no_of_days', 'leave.from_month', 'leave.to_month')
        ->get();
        return DataTables::of($list)->make(true);
    }
}
