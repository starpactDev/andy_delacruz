<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Sender extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'street_address',
        'apt',
        'city',
        'state',
        'zip',
        'telephone',
        'cell',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function orderPickUps()
    {
        return $this->hasMany(OrderPickUp::class, 'sender_id');
    }
}
