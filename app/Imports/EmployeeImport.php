<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Employee;
use App\Constants\GeneralConst;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImport implements ToCollection,WithHeadingRow 
{
    use Importable;

    public function collection(Collection $rows)
    {
        // dd($rows);
        $errors = [];

        // reverse the key-value pairs 
        $positionMap = array_flip(GeneralConst::POSITION);
        $memberMap = array_flip(GeneralConst::MEMBER_TYPES);

        foreach($rows as $index => $row)
        {
            $rowNumber = $index + 2 ; // add 2 to skip heading row
            
            $validator = Validator::make($row->toArray(),[
                'employee_number'   => 'required|string|' . Rule::unique('employees', 'employee_number'),
                'name'              => 'required|string|max:100',
                'email'             => 'required|email|max:50',
                'position'          => 'required|'. Rule::in(GeneralConst::POSITION),
                'gender'            => 'required|string|'. Rule::in(['Male', 'Female']),
                'entry_date'        => 'required',
                'member_type'       => 'required|'. Rule::in(GeneralConst::MEMBER_TYPES),
            ]);
            
            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    $errors[] = "Row $rowNumber: $error";
                }
                continue;
            }
            
            $dob = $this->parseExcelDate($row['dob']);
            $entry_date = $this->parseExcelDate($row['entry_date']);
            $resign_date = $this->parseExcelDate($row['resign_date']);

            $data[] = [
                'employee_number'   => $row['employee_number'],
                'name'              => $row['name'],
                'email'             => $row['email'],
                'password'          => Hash::make("password"),
                'position'          => $positionMap[$row['position']] ?? null,
                'dob'               => $dob,
                'gender'            => $row['gender'],
                'entry_date'        => $entry_date,
                'resign_date'       => $resign_date,
                'member_type'       => $memberMap[$row['member_type']] ?? null,
                'is_admin'          => 0,
                'created_at'        => now()
            ];
        }

        if (!empty($errors)) {
            session()->flash('errors', $errors);
            return;
        }

        Employee::insert($data);

    }


    // to fix income excel date (excel date can be number or date)
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
}
