<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_of_payment',
        'payment_method',
        'paid_to',
        'description',
        'paid_amount',
        'running_total',
        'attachment',  // Add this line to make the attachment field mass assignable

    ];
}
