<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'renew_tag',
        'insurance_renewal',
        'next_oil_change',
        'truck_name',
        'truck_brand',
        'truck_model',
        'color',
        'license_plate',
        'last_mechanic_visit',
        'repairs_done',
        'attachment',
    ];
}
