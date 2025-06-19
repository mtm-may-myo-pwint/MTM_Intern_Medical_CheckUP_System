<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeSaveRequest;

class EmployeeController extends Controller
{
    protected $employee_service;

    public function __construct()
    {
        $this->employee_service = new EmployeeService();
    }

    public function index()
    {
        $employees = $this->employee_service->getEmployeeList();
        return view('employee.index', [
            'employees' => $employees,
        ]);
    }

    
    public function create()
    {
        return view('employee.create');
    }

    
    public function store(EmployeeSaveRequest $request)
    {
        // dd($request->all());
        $this->employee_service->storeEmployee($request);
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        $this->employee_service->deleteEmployee($id);
        return redirect()->route('employee.index')->with('error', 'Employee deleted successfully.');
    }
}
