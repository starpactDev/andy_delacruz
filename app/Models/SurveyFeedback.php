<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_pickup_id',
        'sender_id',
        'satisfaction',
        'booking',
        'arrival_time',
        'package_condition',
        'tracking',
        'customer_support',
        'support_satisfaction',
        'professionalism',
        'improvements',
        'recommend',
        'comments',
    ];

    protected $casts = [
        'improvements' => 'array',
    ];
}
