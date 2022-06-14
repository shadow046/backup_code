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
            $pCode = $branch->provCode;
            return Province::where('provCode', $pCode)->first()->provDesc;
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
    public function validate_updatebranch(Request $request)
    {
        // $currentbranchcode = Branch::query()
        //     ->where('id',$request->id)
        //     ->first()
        //     ->branch_code;
        
        $currentremarks = Branch::query()
            ->where('id',$request->id)
            ->first()
            ->remarks;
        $currentdate = Holiday::query()
            ->where('id',$request->id)
            ->first()
            ->date;
           
        $currentholidaytype = Holiday::where('holiday.id',$request->id)
            ->join('holiday_type', 'holiday_type.id', '=', 'holiday.type')
            ->first()
            ->type;
           
        if($currentholiday == $request->name && $currentremarks == $request->remarks && $currentdate == $request->date && $currentholidaytype == $request->type){
                // $email = 0;
                $result = "nochanges";
            }
            else{
                
                if($currentbranchcode == $request->branchcode){
                    $bCode = 0;
                }
                else{
                    $bCode = Branch::query()->select()
                        ->where('branch_code',$request->branchcode)
                        ->count();
                        // $id = User::query()->select()
                        //     ->where('id',$request->id)
                        //     ->count();
                }
                if($bCode != 0){
                    $result = "duplicate";
                    // dd('duplicate');
                }
                else{
                    $result = 'true';
                }
            }   
        return response($result);
    }

  
}
