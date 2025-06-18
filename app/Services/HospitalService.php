<?php
namespace App\Services;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HospitalService
{
    // Fetch Hospital List
    public function getHospitalList()
    {
        return Hospital::paginate(10);
    }

    // Store and Update Hospital
    public function storeHospital(Request $request)
    {
        try {
            DB::beginTransaction();

            $id = $request->hospital_id;
            
            $hospital = $id ? Hospital::findOrFail($id) : new Hospital();

            $hospital->fill($request->except('hospital_image'));

            if ($request->hasFile('hospital_image')) {

                if ( $hospital->hospital_image ) {
                    if (Storage::disk('public')->exists($hospital->hospital_image)) {
                        Storage::disk('public')->delete($hospital->hospital_image);
                    }
                }

                $image = $request->file('hospital_image');
                $path = $image->store('hospitals', 'public'); 
                $hospital->hospital_image = $path; 
            }

            $hospital->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

    // Get Data for Edit 
    public function getData(Request $request)
    {
        $id = $request->id;
        $hospital = Hospital::findOrFail($id);
        return $hospital;
    }

    // Delete Hospital
    public function deleteHospital($id)
    {
        try{
            DB::beginTransaction();

            $hospital = Hospital::findOrFail($id);

           if ($hospital->hospital_image) {

                if (Storage::disk('public')->exists($hospital->hospital_image)) {
                    Storage::disk('public')->delete($hospital->hospital_image);
                }
            }
            $hospital->delete();

            DB::commit();
            return true;
        }catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

}