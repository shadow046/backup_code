<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;

class ShiftController extends Controller
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
        return view('shift.shift');
    }
    public function shiftTable(){
        // $list = Holiday::select('id','name','type','remarks','date')->get();
        // return DataTables::of($list)->make(true);

        $list = Leave::get();
        return DataTables::of($list)->make(true);
    }
}
