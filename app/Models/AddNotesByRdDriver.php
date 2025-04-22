<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderPickUp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddNotesByRdDriver extends Model
{
    use HasFactory;

    protected $table = 'add_notes_by_rd_drivers'; // Explicitly specify the table name

    // Define the fillable attributes
    protected $fillable = [
        'order_number',
        'order_pickup_id',
        'driver_id',
        'add_note',
    ];

    // Define relationships if needed
    public function orderPickup()
    {
        return $this->belongsTo(OrderPickUp::class, 'order_pickup_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
