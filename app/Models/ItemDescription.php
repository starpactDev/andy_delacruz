<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDescription extends Model
{
    use HasFactory;
    protected $table = 'item_descriptions';

    protected $fillable = [
        'order_pickup_id',
        'quantity',
        'item_des',
        'price',
    ];
}
