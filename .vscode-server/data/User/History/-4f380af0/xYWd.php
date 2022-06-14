<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Holiday;
use App\Models\HolidayType;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;

class HolidayController extends Controller
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
        $holiday = HolidayType::query()->select()->get()->sortBy('name');

        return view('holiday.holiday', compact('holiday'));
        // return view('user.user');
    }

    public function holidayTable(){
        // $list = Holiday::select('id','name','type','remarks','date')->get();
        // return DataTables::of($list)->make(true);

        $list = Holiday::select('holiday.id', 'holiday.name', 'holiday_type.name AS type', 'holiday.remarks','holiday.date' )
        ->join('holiday_type', 'holiday_type.id', '=', 'holiday.type')
        // ->join('holiday', 'holiday.type', '=', 'holiday_type.name')
        ->get();
        return DataTables::of($list)->make(true);
    }


    public function saveholiday(Request $request)
    { 
            $type = HolidayType::query()
            ->where('name',$request->type)
            ->first();
            // return ($type);
            // dd($type);

            $holidays = new Holiday;
            $holidays->name = $request->name;
            $holidays->type = $type->id;
            $holidays->remarks = $request->remarks;
            $holidays->date = $request->date;
           
            if($holidays->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }

    // public function validate_newuser(Request $request)
    // {
    //     $email = User::query()->select()
    //         ->where('email',$request->email)
    //         ->count();
    //     if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
    //         $result = "invalid";
    //     }
    //     else if($email != 0){
    //         $result = "duplicate";
    //     }
    //     else{
    //         $result = 'true';
    //     }
    //     return response($result);
    // }


    public function validate_updateholiday(Request $request)
    {
        $currentemail = User::query()->select()
            ->where('id',$request->id)
            ->first()
            ->email;
            // ->name
        $currentname = User::query()->select()
            ->where('id',$request->id)
            ->first()
            ->name;

        $currentuserlevel = User::select('roles.name AS userlevel')
            ->where('users.id',$request->id)
            ->join('model_has_roles', 'model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->first()
            ->userlevel;

        if($currentemail == $request->email && $currentname == $request->fullname && $currentuserlevel == $request->userlevel){
                // $email = 0;
                $result = "nochanges";
            }
            else{
                
                if($currentemail == $request->email){
                    $email = 0;
                }
                else{
                    $email = User::query()->select()
                        ->where('email',$request->email)
                        ->count();
                        // $id = User::query()->select()
                        //     ->where('id',$request->id)
                        //     ->count();
                }
                if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                    $result = "invalid";
                }
                else if($email != 0){
                    $result = "duplicate";
                    // dd('duplicate');
                }
                else{
                    $result = 'true';
                }
            }   
        return response($result);
    }
    
    public function updateholiday(Request $request)
    {  
       
        $type = HolidayType::query()
        ->where('name',$request->type)
        ->first();
        // return ($type);
        // dd($type);

        $holidays= Holiday::find($request->id);
        $holidays->name = $request->name;
        $holidays->type = $type->id;
        $holidays->remarks = $request->remarks;
        $holidays->date = $request->date;
       
        if($holidays->save()){
            $result = "true";
        }
        else{
            $result = "false";
        }
    return response($result);
    }

    // public function deleteuser(Request $request)
    // {
    //     $users = User::find($request->id);
        
    //     if($users->delete()){
    //         $result= "true";
    //     }
    //     else{
    //         $result ="false";
    //     }
    //     return response($result);
    // }


   
}
