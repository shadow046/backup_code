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
            $leaves = new Leave;
            $leaves->code = $request->leavecode;
            $leaves->type = $request->leavetype;
            $leaves->no_of_days= $request->noofdays;
            $leaves->from_month= $request->availmonthfrom;
            $leaves->to_month= $request->availmonthto;
            $leaves->no_of_days_prior_avail= $request->noofdaystoavail;
            if($leaves->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }
    public function validate_updateleave(Request $request)
    {
        $currentcode = Leave::query()->select()
            ->where('id',$request->id)
            ->first()
            ->code;
        $currenttype = Leave::query()->select()
            ->where('id',$request->id)
            ->first()
            ->type;
        $currentnoofdays = Leave::query()->select()
            ->where('id',$request->id)
            ->first()
            ->no_of_days;
        $currentfrommonth = Leave::query()->select()
            ->where('id',$request->id)
            ->first()
            ->from_month;
        $currenttomonth = Leave::query()->select()
            ->where('id',$request->id)
            ->first()
            ->to_month;
        if($currentcode ==$request->leavecode && $currenttype == $request->leavetype && $currentnoofdays == $request->noofdays&& $currentfrommonth == $request->availmonthfrom && $currenttomonth == $request->availmonthto){
                // $email = 0;
                $result = "nochanges";
            }
            else{
                
                if($currenttype == $request->leavetype){
                    $type = 0;
                }
                else{
                    $type = Leave::query()->select()
                        ->where('type',$request->leavetype)
                        ->count();
                }
                if($type != 0){
                    $result = "duplicate";
                    // dd('duplicate');
                }
                else{
                    $result = 'true';
                }
            }   
        return response($result);
    }
    public function updateleave(Request $request)
    {  
            $leaves= Leave::find($request->id);
            $leaves->code = $request->leavecode;
            $leaves->type = $request->leavetype;
            $leaves->no_of_days= $request->noofdays;
            $leaves->from_month= $request->availmonthfrom;
            $leaves->to_month= $request->availmonthto;
        if($leaves->save()){
            $result = "true";
        }
        else{
            $result = "false";
        }
    return response($result);
    }

}
