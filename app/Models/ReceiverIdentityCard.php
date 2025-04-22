<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverIdentityCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_pickup_id',
        'receiver_id',
        'id_front',
        'id_back',
    ];

    public function orderPickUp()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_pickup_id', 'order_number');
    }
}
