<?php
namespace App\Services;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PackageService
{
    // Fetch Package List
    public function getPackageList()
    {
        return Package::with('hospital')->paginate(10);
    }

    // Store and Update Package
    public function storePackage(Request $request)
    {
        try {
            DB::beginTransaction();

            $id = $request->package_id;
            
            $package = $id ? Package::findOrFail($id) : new Package();

            $package->fill($request->except('package_image'));
            $package->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

    // Delete Hospital
    public function deletePackage($id)
    {
        try{
            DB::beginTransaction();

           $package = Package::findOrFail($id);

           if ($package->package_image) {

                if (Storage::disk('public')->exists($package->package_image)) {
                    Storage::disk('public')->delete($package->package_image);
                }
            }
            $package->delete();

            DB::commit();
            return true;
        }catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

}