<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CheckupService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CheckupInformRequest;

class CheckUpController extends Controller
{
    protected $checkup_service;

    public function __construct()
    {
        $this->checkup_service = new CheckupService();
    }
    
    /**
     * getCheckUpHistory
     *
     * @return void
     */
    public function getCheckUpHistory()
    {
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $packages = Package::pluck('package_name', 'id');

        $chechup_history = $this->checkup_service->getCheckUpHistory();
        // dd($chechup_history);
        return view('checkup.checkup_history',[
            'packages'          => $packages,
            'checkup_history'   => $chechup_history,
        ]);
    }

    /*
    * checkup history filter 
    */
    public function searchCheckUpHistory(Request $request)
    {
        if ($request->ajax()) {

            $checkup_history = $this->checkup_service->searchCheckUpHistory($request);
            // return $checkup_history;
            $html = view('checkup.checkup_table', compact('checkup_history'))->render(); 
            $pagination = $checkup_history->links('pagination::bootstrap-5')->render(); 

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        }
    }

    /*
    ** Checkup Current Month
    */
    public function getCheckUpCurrentMonth()
    {
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = $this->checkup_service->getCheckUpCurrentMonth();
        // dd($employees);
        $packages = Package::pluck('package_name', 'id');

        return view('checkup.checkup_current_month',[
            'employees' => $employees,
            'packages'  => $packages
        ]);
    }

    /*
    * Get Hospital data selected by package
    */
    public function getHospital(Request $request)
    {

        $package = $this->checkup_service->getHospital($request);

        return response()->json($package);
    }

    
    /**
     * informCheckup
     *
     * @param  mixed $request
     * @return void
     */
    public function informCheckup(CheckupInformRequest $request)
    {
        // dd($request->all());

        $checkup = $this->checkup_service->informCheckup($request);

        return back()->with('success', 'Employees informed successfully.');
    }

    public function getCheckUpSurvey()
    {
        abort_if(Gate::denies('is_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $checkup_survey = $this->checkup_service->getCheckUpSurvey();

        dd($checkup_survey);

        return view('checkup.checkup_survey');
    }
}
