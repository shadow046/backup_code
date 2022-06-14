<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\WarehouseImport;
use App\Imports\BranchImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use App\Item;
use App\Customer;
use App\CustomerBranch;
use App\Warehouse;
use App\Stock;
use App\UserLog;
use App\Initial;
use App\Branch;


class ImportController extends Controller
{
    /*<?php

        namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use App\Exports\MttRegistrationsExport;
        use Maatwebsite\Excel\Facades\Excel;

        class ExcelController extends Controller
        {
            public function export(Request $request)
            {
                return Excel::download(new MttRegistrationsExport($request->id), 'MttRegistrations.xlsx');
            }
        }
        */
        /*
        class MttRegistrationsExport implements FromCollection
        {


        protected $id;

        function __construct($id) {
                $this->id = $id;
        }

        /**
        * @return \Illuminate\Support\Collection

        public function collection()
        {
            return MttRegistration::where('lifeskill_id',$this->id)->get()([
                'first_name', 'email'
            ]);
        }
        }*/

    public function branchstore(Request $request)
    {
        $file = $request->file('upload');
        $import = new BranchImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $items = Item::where('item', $value[0])->first();
            //dd($items->category_id);
            if ($items) {
                if ($value[1]) {
                    if (mb_strtolower($value[1]) != 'n/a') {
                        $add = new Stock;
                        $add->user_id = auth()->user()->id;
                        $add->category_id = $items->category_id;
                        $add->branch_id = auth()->user()->branch->id;
                        $add->items_id = $items->id;
                        if (!$value[1]) {
                            $add->serial = 'N/A';
                        }else{
                            $add->serial = mb_strtoupper(str_replace('-', '', preg_replace('/\s+/', '',$value[1])));
                        }
                        $add->status = 'in';
                        $add->save();
                        $log = new UserLog;
                        $log->branch_id = auth()->user()->branch->id;
                    $log->branch = auth()->user()->branch->branch;
                        $log->activity = "ADD $items->item with serial no. $add->serial to stocks" ;
                        $log->user_id = auth()->user()->id;
                    $log->fullname = auth()->user()->name.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
                        $log->save();
                    }else{
                        if ($items->n_a == 'yes') {
                            $add = new Stock;
                            $add->user_id = auth()->user()->id;
                            $add->category_id = $items->category_id;
                            $add->branch_id = auth()->user()->branch->id;
                            $add->items_id = $items->id;
                            if (!$value[1]) {
                                $add->serial = 'N/A';
                            }else{
                                $add->serial = mb_strtoupper(str_replace('-', '', preg_replace('/\s+/', '',$value[1])));
                            }
                            $add->status = 'in';
                            $add->save();
                            $log = new UserLog;
                            $log->branch_id = auth()->user()->branch->id;
                            $log->branch = auth()->user()->branch->branch;
                            $log->activity = "ADD $items->item with serial no. $add->serial to stocks" ;
                            $log->user_id = auth()->user()->id;
                            $log->fullname = auth()->user()->name.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
                            $log->save();
                        }else{
                            $error = 1;
                            array_push($itemswitherror, $value[0].'n/a');
                        }
                    }
                }else{
                    $error = 1;
                    array_push($itemswitherror, $value[0]);
                }
                //dd($add);
            }elseif (!$items) {
                $error = 1;
                array_push($itemswitherror, $value[0]);
            }
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
    
    public function warestore(Request $request)
    {
        /*$file = $request->file('upload');
        $import = new WarehouseImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            $items = Item::where('item', $value[0])->first();
            $branches = Branch::query()->get();
                foreach ($branches as $branch) {
                    Initial::where('branch_id', $branch->id)->where('items_id', $items->id)
                    ->update(['qty' => $value[1]]);
                }
        }*/
        $file = $request->file('upload');
        $import = new WarehouseImport;
        $data = Excel::toArray($import, $file);
        $error = 0;
        $itemswitherror = [];
        foreach ($data[0] as $key => $value) {
            if ($value[1]) {
                $items = Item::where('item', $value[0])->first();
                if ($items) {
                    if ($value[1] && $value[1] != 0) {
                        for ($i=1; $i <= $value[1]; $i++) { 
                            $add = new Warehouse;
                            $add->user_id = auth()->user()->id;
                            $add->category_id = $items->category_id;
                            $add->items_id = $items->id;
                            $add->serial = '-';
                            $add->status = 'in';
                            $log = new UserLog;
                            $log->branch_id = auth()->user()->branch->id;
                $log->branch = auth()->user()->branch->branch;
                            $log->activity = "ADD $items->item to stocks." ;
                            $log->user_id = auth()->user()->id;
                $log->fullname = auth()->user()->name.' '.auth()->user()->middlename.' '.auth()->user()->lastname;
                            $log->save();
                            $add->save();
                        }
                    }
                }elseif (!$items) {
                    $error = 1;
                    array_push($itemswitherror, $value[0]);
                }
            }
        }
        if ($error == 1) {
            return back()->withErrors([$itemswitherror]);
        }else{
            return back()->withStatus('Excel File Imported Successfully');
        }
    }
}