<?php
namespace App\Services;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{

    public function getEmployeeList(Request $request)
    {
        $data = Employee::query();
        if(!empty($request->search))
        {
            $data = $data->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $employee = $data->paginate(10);
        return $employee;
    }

    public function storeEmployee(Request $request)
    {
        try {
            DB::beginTransaction();

            $employee = new Employee();

            $employee->fill($request->except(['password', 'is_admin']));

            if ($request->filled('password')) {
                $employee->password = Hash::make($request->input('password'));
            }

            $employee->is_admin = 0;

            $employee->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }
    public function updateEmployee(Request $request , Employee $employee)
    {
        try {
            DB::beginTransaction();

            $employee->update($request->all());

            DB::commit();
            return true;
        } catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteEmployee($id)
    {
        try{
            DB::beginTransaction();

            $employee = Employee::findOrFail($id);

            $employee->delete();

            DB::commit();
            return true;
        }catch (\Exception $e) {
            // Handle exception
            DB::rollBack();
            throw $e;
        }
    }
}