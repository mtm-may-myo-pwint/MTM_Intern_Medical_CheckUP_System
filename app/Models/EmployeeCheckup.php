<?php

namespace App\Models;

use App\Models\Package;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeCheckup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_checkups';

    protected $fillable = [
        'employee_id',
        'package_id',
        'check_flg',
        'vaccine_flg',
        'last_vaccinated_date',
        'optional_test',
        'form_deadline_date',
        'status',
        'checkup_date',
        'checkup_time',
        'transportation_info'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
