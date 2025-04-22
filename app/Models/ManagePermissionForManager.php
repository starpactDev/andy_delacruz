<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePermissionForManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'key', 'value'
    ];
}
