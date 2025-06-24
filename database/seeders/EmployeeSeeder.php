<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('employees')->truncate();
        DB::table('employees')->delete();
        Employee::insert([
            [
                'employee_number'   => "E00001",
                'email'             => 'admin@gmail.com',
                'name'              => 'Admin',
                'password'          => Hash::make('password'),
                'entry_date'        => now(),
                'position'          => 0 ,
                'member_type'       => 0 ,
                'is_admin'          => 1 ,
                'created_at'        => now()
            ]
        ]);
    }
}
