<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        $role = Role::query()->select()->get()->sortBy('name');

        return view('user.user', compact('role'));
        // return view('user.user');
    }
    public function saveuser(Request $request)
    { 
            $users = new User;
            $users->name = $request->fullname;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->assignRole($request->userlevel);
            if($users->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }

    public function validate_newuser(Request $request)
    {
        $email = User::query()->select()
            ->where('email',$request->email)
            ->count();
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
    public function validate_updateuser(Request $request)
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
    
    public function updateuser(Request $request)
    {  
        $users = User::find($request->id);
        $users->name = $request->fullname;
        $users->email = $request->email;
        $users->syncRoles($request->userlevel);
        if($users->save()){
            $result= "true";
        }
        else{
            $result ="false";
        }
        return response($result);
    }

    public function deleteuser(Request $request)
    {
        $users = User::find($request->id);
        
        if($users->delete()){
            $result= "true";
        }
        else{
            $result ="false";
        }
        return response($result);
    }


    public function userTable(){
        // $list = User::select('id','name','email')->get();
        // return DataTables::of($list)->make(true);

        $list = User::select('users.id AS id', 'users.name AS name', 'users.email AS email', 'roles.name AS userlevel')
        ->join('model_has_roles', 'model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->get();

    return DataTables::of($list)->make(true);


    }
}
