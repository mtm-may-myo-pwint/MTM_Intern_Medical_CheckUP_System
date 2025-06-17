<?php
namespace App\Services;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalService
{
    // Fetch Hospital List
    public function getHospitalList()
    {
        return Hospital::paginate(10);
    }

    // Store Hospital
    public function storeHospital(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            
            $hospital = $id ? Hospital::findOrFail($id) : new Hospital();

            $hospital->fill($request->all())->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

}