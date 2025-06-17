<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalService;
use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalSaveRequest;

class HospitalController extends Controller
{
    protected $hospital_service;

    public function __construct()
    {
        $this->hospital_service = new HospitalService();
    }

    public function getHospital()
    {
        $hospitals = $this->hospital_service->getHospitalList();
        return view('hospital.index', [
            'hospitals' => $hospitals,
        ]);
    }

    public function storeHospital(HospitalSaveRequest $request)
    {
        $this->hospital_service->storeHospital($request);
        return redirect()->route('hospital.index')->with('success', 'Hospital created successfully.');
    }
}
