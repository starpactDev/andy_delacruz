<?php

namespace App\Models;

use App\Models\Sender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receiver extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id',
        'first_name',
        'last_name',
        'second_last_name',
        'nickname',
        'email',
        'address',
        'neighborhood',
        'city',
        'province',
        'reference',
        'telephone',
        'cell',
        'whatsapp',
    ];
    public function sender()
    {
        return $this->belongsTo(Sender::class);
    }
}
