<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureSender extends Model
{
    use HasFactory;
    protected $table = 'signature_senders';

    protected $fillable = [
        'sender_id',
        'order_id',
        'order_pickup_id',
        'signature_image',
    ];

    public function orderPickUp()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_pickup_id', 'order_number');
    }
}
