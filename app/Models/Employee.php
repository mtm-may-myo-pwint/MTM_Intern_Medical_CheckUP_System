<?php

namespace App\Models;

use App\Models\EmployeeCheckup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

       /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function employeeCheckup(){
        return $this->hasMany(EmployeeCheckup::class);
    }
}
