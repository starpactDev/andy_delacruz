<?php

namespace App\Models;

use App\Models\Sender;
use App\Models\Receiver;
use App\Models\OrderPayment;
use App\Models\ItemDescription;
use App\Models\SignatureSender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderPickUp extends Model
{
    use HasFactory;
    protected $table = 'order_pickups';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'invoice_number',
        'issue_date',
        'order_number',
        'container_number',
        'driver_pickup_name',
        'driver_id',
        'total',
        'discount',
        'grand_total_amount',
        'total_no_packages',
        'payment_method',
        'payment_location',
        'amount_paid',
        'label_count',
        'is_completed',
        'package_status'
    ];


    public function sender()
    {
        return $this->belongsTo(Sender::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(Receiver::class, 'receiver_id');
    }

    public function itemDescriptions()
    {
        return $this->hasMany(ItemDescription::class, 'order_pickup_id', 'order_number');
    }

    public function signatureSender()
    {
        return $this->hasOne(SignatureSender::class, 'order_pickup_id', 'order_number');
    }
    public function signatureReceiver()
    {
        return $this->hasOne(ReceiverSignature::class, 'order_pickup_id', 'order_number');
    }

    public function assignedOrderToDriver()
    {
        return $this->hasOne(AssignedOrderToDriver::class, 'order_pickup_id');
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class, 'order_pickup_id');
    }
}
