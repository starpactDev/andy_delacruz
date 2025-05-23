<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secretary extends Model
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
