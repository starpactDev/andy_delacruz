<?php

namespace App\Models;

use App\Models\OrderPickUp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeftoverPackage extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'old_container_id',
        'new_container_id',
    ];

    public function orderPickup()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_id', 'order_number');
    }
}
