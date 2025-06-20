<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Employee;
use App\Constants\GeneralConst;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements ToModel,WithHeadingRow ,WithValidation , SkipsOnFailure
{
    use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function parseExcelDate($value)
    {
        if (empty($value)) {
            return null; 
        }

        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        } else {
            try {
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch (\Exception $e) {
                try {
                    return Carbon::parse($value)->format('Y-m-d');
                } catch (\Exception $e) {
                    return null;
                }
            }
        }
    }

    public function model(array $row)
    {
        // dd($row);
    
        $positionMap = array_flip(GeneralConst::POSITION);
        $row['position'] = $positionMap[$row['position']] ?? null;
        
        $memberMap = array_flip(GeneralConst::MEMBER_TYPES);
        $row['member_type'] = $memberMap[$row['member_type']] ?? null;

        $dob = $this->parseExcelDate($row['dob']);
        $entry_date = $this->parseExcelDate($row['entry_date']);
        $resign_date = $this->parseExcelDate($row['resign_date']);

        $employee =  Employee::create([
                        'employee_number'   => $row['employee_number'],
                        'name'              => $row['name'],
                        'email'             => $row['email'],
                        'password'          => Hash::make("12345"),
                        'position'          => $row['position'],
                        'dob'               => $dob,
                        'gender'            => $row['gender'],
                        'entry_date'        => $entry_date,
                        'resign_date'       => $resign_date,
                        'member_type'       => $row['member_type'],
                        'is_admin'          => 0,
                    ]);
        return $employee;
    }



    public function rules(): array
    {
        return [
            'employee_number'   => 'required|string|' . Rule::unique('employees', 'employee_number'),
            'name'              => 'required|string|max:100',
            'email'             => 'required|email|max:50',
            'position'          => 'required',
            'gender'            => 'required|string',
            'entry_date'        => 'required',
            'member_type'       => 'required',
        ];
    }
}
