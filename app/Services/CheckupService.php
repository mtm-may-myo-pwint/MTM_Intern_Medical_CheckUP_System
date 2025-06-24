<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Constants\GeneralConst;
use App\Models\EmployeeCheckup;


class CheckupService
{

    public function getCheckUpHistory()
    {
        $from_date = now()->subYear()->startOfYear(); // last year Jan
        $to_date = now()->endOfMonth(); // current month

        $checkup_history = EmployeeCheckup::with('employee','package')
                            ->where('status' , GeneralConst::CONFIRM)
                            ->whereBetween('checkup_date', [$from_date, $to_date])
                            ->whereHas('employee', function ($query) { // not include resign employee
                                $query->whereNull('resign_date');
                            })
                            ->get()
                            ->groupBy('employee_id');
        return $checkup_history;
    }

    // search checkup history
    public function searchCheckUpHistory(Request $request)
    {
        $from_date = Carbon::createFromFormat('Y-m', $request->from_date)->startOfMonth(); // Change Y-m to full date
        $to_date   = Carbon::createFromFormat('Y-m', $request->to_date)->endOfMonth();

        $data = EmployeeCheckup::with('employee','package')
                            ->where('status' , GeneralConst::CONFIRM)
                            ->whereBetween('checkup_date', [$from_date, $to_date]);
        
        // search by name
        if (!empty($request->search)) {
            $data->whereHas('employee', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            });
        }

        // search by package
        if(!empty($request->package_id)){
           $data = $data->where('package_id',$request->package_id);
        }

        // check resign member checkbox
        if(!$request->resign_member){
            $data = $data->whereHas('employee', function ($query) { 
                                $query->whereNull('resign_date');
                            });
        }
        
        $checkup_history = $data->get()->groupBy('employee_id');
                            
        return $checkup_history;
    }

}