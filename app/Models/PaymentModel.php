<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'payment_method',
        'order_payment_id',
        'transaction_id',
        'amount',
        'payment_status',
    ];
}
