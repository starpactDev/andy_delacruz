<?php

namespace App\Models;

use App\Models\Sender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContainerOrderDetail extends Model
{
    use HasFactory;

    // Define the relationship with the Sender model
    public function sender()
    {
        return $this->belongsTo(Sender::class, 'customer_id');
    }
}
