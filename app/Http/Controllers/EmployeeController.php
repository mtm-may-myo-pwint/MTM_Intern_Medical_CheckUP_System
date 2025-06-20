<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Imports\EmployeeImport;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
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
        $employee = new Employee();
        return view('employee.save',[
            'employee'  => $employee
        ]);
    }

    
    public function store(EmployeeSaveRequest $request)
    {
        // dd($request->all());
        $this->employee_service->storeEmployee($request);
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    
    public function show(string $id)
    {
        
    }

    
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.save',[
            'employee'  => $employee
        ]);
    }

    
    public function update(EmployeeSaveRequest $request, Employee $employee)
    {
        // dd($request->all());
        $this->employee_service->updateEmployee($request,$employee);
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

   
    public function destroy(string $id)
    {
        $this->employee_service->deleteEmployee($id);
        return redirect()->route('employee.index')->with('error', 'Employee deleted successfully.');
    }

    public function importExcel(Request $request)
    {
        try {
            if ($request->file) {

                $import = new EmployeeImport();

                Excel::import($import, $request->file('file')->store('files'));

                $failures = $import->failures();

                if ($failures->isNotEmpty()) {
                    $errorMessages = [];

                    foreach ($failures as $failure) {
                        $row = $failure->row();
                        $attribute = $failure->attribute();
                        $errors = implode(', ', $failure->errors());
                        $errorMessages[] = "Row {$row} - {$attribute}: {$errors}";
                    }

                    return redirect()->back()->withErrors($errorMessages);
                }
            }

            return redirect()->back()->with('success', 'Employee data successfully imported.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors());
        }
    }
}
