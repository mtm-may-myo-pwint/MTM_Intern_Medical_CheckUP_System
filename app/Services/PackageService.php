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

           if ($request->hasFile('package_image')) {

                if ($package->package_image) {
                    if (Storage::disk('public')->exists($package->package_image)) {
                        Storage::disk('public')->delete($package->package_image);
                    }
                }

                $image = $request->file('package_image');
                $path = $image->store('packages', 'public');
                $package->package_image = $path;

            } elseif ($request->has('remove_package_image') && $request->remove_package_image == '1') {

                if ($package->package_image) {
                    if (Storage::disk('public')->exists($package->package_image)) {
                        Storage::disk('public')->delete($package->package_image);
                    }
                }

                $package->package_image = null;
            }


            $package->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

    // Get Package Data for Edit 
    public function getData(Request $request)
    {
        $id = $request->id;
        $package = Package::findOrFail($id);
        return $package;
    }

    // Delete Package
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