<?php

namespace App\Http\Controllers;
use App\Models\Leave;
use Yajra\Datatables\Datatables;
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

        $list = Leave::get();
        return DataTables::of($list)->make(true);
    }

    public function validate_newleave(Request $request)
    {
        $leavetype = Leave::query()->select()
            ->where('type',$request->leavetype)
            ->count();
        if($leavetype != 0){
            $result = "duplicate";
        }
        else{
            $result = 'true';
        }
        return response($result);
    }
    public function saveleave(Request $request)
    { 
        if ($request->availmonthfrom == "January"){
            $availfrom = 1;
            $availto = 1;

        }
            $leaves = new Leave;
            $leaves->code = $request->leavecode;
            $leaves->type = $request->leavetype;
            $leaves->no_of_days= $request->noofdays;
            $leaves->from_month= $availfrom;
            $leaves->to_month= $availto;
            if($leaves->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }

}
