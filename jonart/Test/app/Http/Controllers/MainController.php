<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserLogs;
use Illuminate\Support\Facades\Hash;
use DB;


class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modal(){
        return view('/modal');
    }
    
    public function index(){         
        // dd(auth()->user()->id); 
        return view('/auth/login');
    }
    public function home()
    {
        $list = DB::table('user_logs')->get();
         return view('/pages/home', compact('list'));         
    }public function users()
    {           
        $list = DB::table('admins')->get();
        //  dd($list);

         return view('/pages/users', compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('/auth/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:5|max:12'
        ]);
        
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password =Hash::make($request->password);
        $admin->userlevel = $request->userlevel;
        $admin->status = $request->status;
        $save= $admin->save();

        if($save){
            return back()->with('success','New user has created successfuly');
        }else{
            return back()->with('fail','something went wrong, please try again');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);
        
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password =Hash::make($request->password);
        $admin->userlevel = $request->userlevel;
        $admin->status = $request->status;
        $save= $admin->save();

        if($save){
            return back()->with('success','New user has created successfuly');
        }else{
            return back()->with('fail','something went wrong, please try again');
        }
    }

    public function check(Request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        $userinfo= Admin::where('email','=',$request->email)->first();
        
        if(!$userinfo){
            return back()->with('fail','We do not recognize your email address.');
        }else{
            //check password
            if(Hash::check($request->password, $userinfo -> password)){
                $request->session()->put('LoggedUser',$userinfo->id);
                return redirect('admin/dashboard');
            }else{
                return back()->with('fail','Incorrect password!');
            }
        }
    }


    public function dashboard(){
       $list = DB::table('lccs')->get();
        // dd($list);
        return view('admin.dashboard', compact('list'));
    } 
    
    public function logout(){
        if(session()->has('LoggedUse')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }
    
}
