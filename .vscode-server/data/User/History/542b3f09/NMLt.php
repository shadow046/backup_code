<?php

namespace App\Http\Controllers;
use \App\Models\Leave;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
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
        $leavetype = Leave::query()->select()->get()->sortBy('type');
        return view('employee.leavecredit', compact('leavetype'));
    }
}
