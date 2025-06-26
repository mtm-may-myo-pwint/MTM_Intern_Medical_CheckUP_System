<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Constants\GeneralConst;
use App\Models\EmployeeCheckup;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


class CheckupService
{
    /*
    * pagination
    */ 
    public function pagination(array $items , int $perPage){
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);

        return new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage,[
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }

     /*
    * Retrieve checkup history list where status confirm and date between last year january and current month
    */ 
    public function getCheckUpHistory()
    {
        $from_date = now()->subYear()->startOfYear(); // last year Jan
        $to_date = now()->endOfMonth(); // current month

        $items = EmployeeCheckup::with('employee','package')
                            ->where('status' , GeneralConst::CONFIRM)
                            ->whereBetween('checkup_date', [$from_date, $to_date])
                            ->whereHas('employee', function ($query) { // not include resign employee
                                $query->whereNull('resign_date');
                            })
                            ->get()
                            ->groupBy('employee_id');

        $items = $items->toArray();
        
        $checkup_history = $this->pagination($items , 10);

        return $checkup_history;
    }

    /*
    * checkup history filter 
    */ 
    public function searchCheckUpHistory(Request $request)
    {
        $from_date = $request->from_date ? Carbon::createFromFormat('Y-m', $request->from_date)->startOfMonth() : null;
        $to_date   = $request->to_date ? Carbon::createFromFormat('Y-m', $request->to_date)->endOfMonth() : null;

        $data = EmployeeCheckup::with('employee','package')
                            ->where('status' , GeneralConst::CONFIRM);
                            
        if (!empty($from_date) && !empty($to_date)) {
            $data->whereBetween('checkup_date', [$from_date, $to_date]);
        } elseif (!empty($from_date)) {
            $data->where('checkup_date', '>=', $from_date);
        } elseif (!empty($to_date)) {
            $data->where('checkup_date', '<=', $to_date);
        }
        
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
        
        $items = $data->get()->groupBy('employee_id');
                            
        $items = $items->toArray();
        
        $checkup_history = $this->pagination($items , 10);
      
        return $checkup_history;
    }

    /*
    * Retrieve checkup current month list
    * new employee and old employee whose last checkup was over a year ago from the current month
    */ 

    public function getCheckUpCurrentMonth()
    {
        $lastyear = now()->subYear();

        // return $lastyear;

        $employee = Employee::with('employeeCheckup')
                            ->where('is_admin',GeneralConst::FALSE)
                            ->whereNull('resign_date')
                            ->where(function($query) use($lastyear){
                                $query->where('member_type', GeneralConst::NEW)
                                    ->orWhere(function($q) use($lastyear) {
                                        $q->where('member_type', GeneralConst::OLD)
                                        ->whereRaw('(
                                            SELECT MAX(checkup_date)
                                            FROM employee_checkups
                                            WHERE employee_checkups.employee_id = employees.id
                                        ) <= ?', [$lastyear])
                                        ->orWhereDoesntHave('employeeCheckup');
                                });
                            })
                            ->get();

        return $employee;
    }

    public function getHospital (Request $request){

        $package = Package::with('hospital')->findOrFail($request->package_id);

        return $package;
        
    }

    public function informCheckup(Request $request){

        try {
            DB::beginTransaction();

            if(!empty($request->checkup)){

                foreach($request->checkup as $checkup){
     
                     EmployeeCheckup::create([
                         'employee_id'           => $checkup,
                         'package_id'            => $request->package_id,
                         'form_deadline_date'    => $request->deadline_date,
                         'status'                => GeneralConst::INFORM
                     ]);
                }
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

}