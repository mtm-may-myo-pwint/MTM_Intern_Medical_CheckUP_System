<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\PackageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PackageSaveRequest;

class PackageController extends Controller
{
    protected $package_service;

    public function __construct()
    {
        $this->package_service = new PackageService();
    }

     public function getPackage()
    {
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $packages = $this->package_service->getPackageList();

        return view('package.index', [
            'packages' => $packages,
            'hospitals' => Hospital::all()
        ]);
    }

    public function storePackage(PackageSaveRequest $request)
    {
        // dd($request->all());
        $this->package_service->storePackage($request);
        if($request->package_id)
        {
            return redirect()->route('package.index')->with('success', 'Package updated successfully.');
        }
        return redirect()->route('package.index')->with('success', 'Package created successfully.');
    }

    public function getData(Request $request)
    {
        $package = $this->package_service->getData($request);
        return response()->json([
            'data' => $package
        ]);
    }

    public function deletePackage($id)
    {
        $this->package_service->deletePackage($id);
        return redirect()->route('package.index')->with('error', 'Package deleted successfully.');
    }
}
