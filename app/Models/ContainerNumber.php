<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerNumber extends Model
{
    use HasFactory;
    protected $table = 'container_numbers';

    // Allow mass assignment for 'key' and 'value'
    protected $fillable = ['key', 'value'];
}
