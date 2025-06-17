<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hospitals';

    protected $fillable = [
        'hospital_name',
        'hospital_image',
        'hospital_address',
        'hospital_ph_no'
    ];
}
