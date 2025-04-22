<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotentialCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'full_name',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'zip',

    ];
}
