<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Province;
use App\Models\City;
use App\Models\Region;
use App\Models\Branch;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Validator,Redirect,Response;

class BranchController extends Controller
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
        // $provincetypes = Province::query()->select()->get()->sortBy('provDesc');
        // return view('branch.branch', compact('provincetypes'));
        $data['refprovinces'] = Province::orderBy('provDesc','Asc')->get(["provDesc","provCode"]);
        return view('branch.branch',$data);
    }
    public function getCity(Request $request)
    {
        $data['refcitymuns'] = City::where("provCode",$request->provincecode)
        ->orderBy('citymunDesc','Asc')
        ->get(["citymunCode","citymunDesc"]);
        return response()->json($data);
    }
    public function getRegion(Request $request)
    {
        $regcode = City::where("citymunCode",$request->citymunCode)->first()->regCode;
        $data['refregions'] = Region::where("regCode",$regcode)->get(["regCode","regDesc"]);
        return response()->json($data);
    }
    public function branchTable(){

        $list = Branch::get();
        return DataTables::of($list)
        ->addColumn('Province', function(Branch $branch){
            // $pCode = $branch->provCode;
            return Province::where('provCode',$branch->provCode)->first()->provDesc;
        })
        ->addColumn('City', function(Branch $branch){
            $city = City::where('citymunCode', $branch->citymunCode)->first();
            return $city->citymunDesc;
        })
        ->addColumn('Region', function(Branch $branch){
            $region = Region::where('regCode', $branch->regCode)->first();
            return $region->regDesc;
        })
        // ->addColumn('Province1', function(Branch $branch){
        //     $pCode = $branch->provCode;
        //     $province = Province::where('provCode', $pCode)->first()->provDesc;
        //     $city = City::where('citymunCode', $branch->citymunCode)->first();
        //     return $province.'-'.$city->citymunDesc.'-'.$city->citymunCode;
        // })
        ->make(true);
    }
    public function savebranch(Request $request)
    { 
            $branchs = new Branch;
            $branchs->branch_code = $request->branchcode;
            $branchs->branch_name = $request->branchname;
            $branchs->address = $request->address;
            $branchs->provCode = $request->province;
            $branchs->citymunCode = $request->city;
            $branchs->regCode = $request->region;
            $branchs->status = $request->status;
           
            if( $branchs->save()){
                $result = "true";
            }
            else{
                $result = "false";
            }
        return response($result);
    }
    public function updatebranch(Request $request)
    {  
       
        $branchs= Branch::find($request->id);
        $branchs->branch_code = $request->branchcode;
        $branchs->branch_name =  $request->branchname;
        $branchs->address = $request->address;
        $branchs->provCode = $request->province;
        $branchs->citymunCode = $request->city;
        $branchs->regCode = $request->region;
        $branchs->status = $request->status;
        if($branchs->save()){
            $result = "true";
        }
        else{
            $result = "false";
        }
         return response($result);
        }
        var maxStack = 10000; 
        // Maximum call stack size var 

        num = 0; 
        // Number of function calls 

        function nested() { 
        // Nested function 
        num++; 
        // Increase the number of function calls 
        if (num > maxStack) { 
        // Check if stack size has been exceeded 
        throw new RangeError("Maximum call stack size exceeded"); 
        } 
        nested(); 
        // Call the nested function again 
        } 
        nested(); 
        // Call the nested function again
}
