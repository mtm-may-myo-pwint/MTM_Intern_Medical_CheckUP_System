<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'employee_number',
        'email',
        'password',
        'name',
        'entry_date',
        'resign_date',
        'position',
        'dob',
        'member_type',
        'is_admin',
        'gender',
    ];
}
