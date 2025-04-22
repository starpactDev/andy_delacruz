<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderIdentityCard extends Model
{
    use HasFactory;

    protected $table = 'sender_identity_cards';

    protected $fillable = [
        'order_pickup_id',
        'sender_id',
        'id_front',
        'id_back',
    ];
}
