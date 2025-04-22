<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderPickUp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignedOrderToDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'order_number',
        'driver_id',
        'order_pickup_id',
    ];

    public function orderPickup()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_pickup_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
