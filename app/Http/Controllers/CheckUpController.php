<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CheckupService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CheckUpController extends Controller
{
    protected $checkup_service;

    public function __construct()
    {
        $this->checkup_service = new CheckupService();
    }

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

    public function searchCheckUpHistory(Request $request)
    {
        $chechup_history = $this->checkup_service->searchCheckUpHistory($request);

        return response()->json([
            'data' => $chechup_history,
        ]);
    }
}
