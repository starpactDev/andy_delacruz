<?php

namespace App\Models;

use App\Models\PotentialCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreateEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'event_date',
        'assigned_employee',
        'start_time',
        'end_time',
        'comments',
        'color',
        'assigned_driver',
        'is_completed',
        'status',
        'assigned_customer' // Added new field

    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'assigned_driver');
    }
    public function assignedEmployee()
    {
        return $this->belongsTo(PotentialCustomer::class, 'assigned_employee');
    }
    // Add a method to count orders for the driver
    public static function countPickupOrders($driverId)
    {
        return self::where('assigned_driver', $driverId)
                    ->where('is_completed', 0) // Orders that are not completed
                    ->count();
    }
}
