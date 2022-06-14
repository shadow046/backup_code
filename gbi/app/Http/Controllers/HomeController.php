<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use App\Mail\EmailForQueuing;
use Route;
use Validator;
use App\User;
use App\Bstock;
use App\Branch;
use App\Responder;
use App\Item;
use App\Loan;
use App\Initial;
use App\Warehouse;
use App\StockRequest;
use App\PreparedItem;
use App\Category;
use App\Stock;
use App\Defective;
use App\Customer;
use App\CustomerBranch;
use DB;
use App\UserLog;
use Carbon\Carbon;
use Mail;
use Auth;
use Config;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        return view('pages.home');
    }
    public function getticket()
    {
        if(DB::connection()->getDatabaseName()){
            // $tasks =  DB::table('task')->select(
            //     DB::raw(
            //         'SUM(CASE WHEN value = \'POS Application\' THEN 1 ELSE Null END) as POS_Application'
            //     ),
            //     DB::raw(
            //         'SUM(CASE WHEN value = \'Price Change\' THEN 1 ELSE Null END) as Price_Change'
            //     ),
            //     DB::raw(
            //         'SUM(CASE WHEN value = \'Internet\' THEN 1 ELSE Null END) as Internet'
            //     ),
            // )
            // ->where('TaskNumber', 'LIKE', 'GBI%')
            // ->join('form', 'taskid', 'task.id')
            // ->join('formfield', 'formid', 'form.id')
            // // ->where('TaskStatus', '!=', 'Submitted')
            // ->where('label', 'Sub Category')
            // ->wherein('value', ['POS Application', 'Price Change', 'Internet'])
            // ->groupBy('value')
            // ->get();
            // return [
            //     'POS Applicatiom' => $tasks->POS_Application,
            //     'Price Change' => $tasks->Price_Change,
            //     'Internet' => $tasks->Internet
            // ];
            $task =  DB::table('task')->select('DateCreated','TaskNumber','CreatedBy','TaskStatus')
            ->join('form', 'taskid', 'task.id')
            ->join('formfield', 'formid', 'form.id')
            ->where('TaskNumber', 'LIKE', 'GBI%')
            ->where('TaskStatus', '!=', 'Submitted')
            ->get();
        }
        return DataTables::of($task)
        ->addColumn('DateCreated', function ($task){
            return Carbon::parse($task->DateCreated)->isoFormat('lll');
        })
       
        ->make(true);
        
    }
    public function taskdata(Request $request)
    {
        if(DB::connection()->getDatabaseName()){
            if(DB::connection()->getDatabaseName()){
                $storecode = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Store Code')
                    ->select('value')
                    ->first()->value;
                $storename = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Store Name')
                    ->select('value')
                    ->first()->value;
                $storeaddress = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Store Address')
                    ->select('value')
                    ->first()->value;
                $contactperson = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Contact Person')
                    ->select('value')
                    ->first()->value;
                $contactnumber = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Contact Number')
                    ->select('value')
                    ->first()->value;
                $email = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Email Address')
                    ->select('value')
                    ->first()->value;
                $responsetime = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Response Time')
                    ->select('value')
                    ->first()->value;
                $createdby = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Created By')
                    ->select('value')
                    ->first()->value;
                $problemreported = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Problem Reported')
                    ->select('value')
                    ->first()->value;
                $problemcategory = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Problem Category')
                    ->select('value')
                    ->first()->value;
                $subcategory = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Sub Category')
                    ->select('value')
                    ->first()->value;
                $machinemodel = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Machine Model')
                    ->select('value')
                    ->first()->value;
                $rootcause = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Root Cause')
                    ->select('value')
                    ->first()->value;
                $incidentstatus = DB::table('task')
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->where('TaskNumber', $request->TaskNumber)
                    ->where('label', 'Incident Status')
                    ->select('value')
                    ->first()->value;

                return response()->json(
                    [
                        'Store_Code'=>$storecode,
                        'Store_Name'=>$storename,
                        'Store_Address'=>$storeaddress,
                        'Contact_Person'=>$contactperson,
                        'Contact_Number'=>$contactnumber,
                        'Email_Address'=>$email,
                        'Response_Time'=>$responsetime,
                        'Created_By'=>$createdby,
                        'Problem_Reported'=>$problemreported,
                        'Problem_Category'=>$problemcategory,
                        'Sub_Category'=>$subcategory,
                        'Machine_Model'=>$machinemodel,
                        'Root_Cause'=>$rootcause,
                        'Incident_Status'=>$incidentstatus
                    ]
                );
                $taskdata = DB::table('task')->select('label','value')
                    ->where('TaskNumber', 'LIKE', '%20210626-50365')
                    ->wherein('label', 
                        [
                            'Store Code',
                            'Store Name',
                            'Store Address',
                            'Region',
                            'Province / Municipality',
                            'Contact Person',
                            'Contact Number',
                            'Email Address',
                            'Response Time',
                            'Created By',
                            'Problem Reported',
                            'Problem Category',
                            'Sub Category',
                            'Machine Model',
                            'Root Cause',
                            'Incident Status'
                        ]
                    )
                    ->join('form', 'taskid', 'task.id')
                    ->join('formfield', 'formid', 'form.id')
                    ->get();
                }
        }
        return DataTables::of($task)->make(true);
        
    }
}