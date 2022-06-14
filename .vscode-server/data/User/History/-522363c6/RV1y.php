<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function shiftTable()
    {
        $list = Shift::get();
        return DataTables::of($list)->make(true);
    }
    public function saveshift(Request $request)
    { 
            $shifts = new Shift;
            $shifts->code = $request->shiftcode;
            $shifts->start = $request->start;
            $shifts->break_1 = $request->break1;
            $shifts->break_2 = $request->break2;
            $shifts->end = $request->end;
            $shifts->total_hours = $request->totalhours;
            if($shifts->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }

}
