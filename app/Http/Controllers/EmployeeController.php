<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Imports\EmployeeImport;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\EmployeeSaveRequest;

class EmployeeController extends Controller
{
    protected $employee_service;

    public function __construct()
    {
        $this->employee_service = new EmployeeService();
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = $this->employee_service->getEmployeeList($request);
        return view('employee.index', [
            'employees' => $employees,
        ]);
    }

    
    public function create()
    {
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('is_admin'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
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
        if ($request->file) {

            try{
                $import = new EmployeeImport();

                Excel::import($import, $request->file('file')->store('files'));

                if (session()->has('errors')) {
                    return redirect()->back()->withErrors(session('errors'));
                }

                return redirect()->back()->with('success', 'Employee data successfully imported.');

            } catch (ValidationException $e) {
                return redirect()->back()->withErrors($e->validator->errors());
            }

        }
    }
}
