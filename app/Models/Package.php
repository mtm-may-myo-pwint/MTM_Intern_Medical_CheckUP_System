<?php

namespace App\Models;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'packages';

    protected $fillable = [
        'package_name',
        'package_price',
        'hospital_id',
        'package_type',
        'package_year',
        'package_image'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class,'hospital_id');
    }
}
