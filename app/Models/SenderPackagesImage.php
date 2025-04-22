<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderPackagesImage extends Model
{
    use HasFactory;
    protected $table = 'sender_packages_images';

    protected $fillable = [
        'order_pickup_id',
        'sender_id',
        'image',
    ];
}
