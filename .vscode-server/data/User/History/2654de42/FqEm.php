<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Branch;
use App\Models\EmployeeStatus;
use App\Models\ApprovingGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
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
        $userlevel = Role::query()->select()->get()->sortBy('name');
        $branchname = Branch::query()->select()->get()->sortBy('branch_name');
        $employeestatus = EmployeeStatus::query()->select()->get()->sortBy('name');
        $leavetype = Leave::query()->select()->get()->sortBy('type');
        return view('employee.employee', compact('branchname','userlevel','employeestatus', 'leavetype'));
    }
    public function employeeTable(){
        $list = Employee::get();
        return DataTables::of($list)->make(true);
    }
    public function getnoofdays(Request $request)
    {
        $noofDays = Leave::where("code",$request->leaveCode)->first()->no_of_days;
        return response($noofDays);
    }
    public function leaveTable(Request $request){
        $table = Leave::get()
        ->whereIn('gender',[$request->gender, 'Both']);
        return DataTables::of($table)->make(true);
    }
    public function approvinggroupTable(Request $request){
        $table = ApprovingGroup::get()
        ->whereIn('branch_name',$request->branchname);
        return DataTables::of($table)->make(true);
    }
    public function saveemployee(Request $request)
    { 
            $employees = new Employee;
            $employees->first_name= $request->firstname;
            $employees->last_name= $request->lastname;
            $employees->middle_name= $request->middlename;
            $employees->employee_no= $request->employeeno;
            $employees->gender= $request->gender;
            $employees->shift= $request->shift;
            $employees->position =$request->position;
            $employees->branc_hname= $request->branchname;
            $employees->date_hired= $request->datehired;
            $employees->email= $request->email;
            $employees->contact_no=$request->contactno;
            $employees->address= $request->address;
            $employees->status= $request->employeestatus;
            $employees->level= $request->userlevel;
           
            if($employees->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }
}
