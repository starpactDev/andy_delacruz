<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'street_address', 'city', 'state', 'zip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
