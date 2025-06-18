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
        // dd($request->all());
        $this->hospital_service->storeHospital($request);

        if($request->hospital_id)
        {
            return redirect()->route('hospital.index')->with('success', 'Hospital updated successfully.');
        }
        return redirect()->route('hospital.index')->with('success', 'Hospital created successfully.');
    }

    public function getData(Request $request)
    {
        $hospital = $this->hospital_service->getData($request);
        return response()->json([
            'data' => $hospital
        ]);
    }

    public function deleteHospital($id)
    {
        $this->hospital_service->deleteHospital($id);
        return redirect()->route('hospital.index')->with('error', 'Hospital deleted successfully.');
    }
}
