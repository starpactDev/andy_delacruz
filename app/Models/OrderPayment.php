<?php

namespace App\Models;

use App\Models\OrderPickUp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_pickup_id',
        'deposit',
        'payment_method',
        'exchange_confirmation_number'
    ];

    /**
     * Define a relationship with the OrderPickup model.
     */
    public function orderPickup()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_pickup_id');
    }
}
