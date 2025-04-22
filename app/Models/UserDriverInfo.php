<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDriverInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'street',
        'city',
        'state',
        'zip',
        'team',
        'second_last_name',
        'nickname',
        'neighborhood',
        'province',
        'reference',
        'cell',
        'whatsapp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
