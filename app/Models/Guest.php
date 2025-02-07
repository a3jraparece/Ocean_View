<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $table = 'guests';

    protected $primaryKey = 'guestID';

    protected $fillable = [
        'guestID',
        'username',
        'password',
        'f_name',
        'm_name',
        'l_name',
        'phone_number',
        'email',
        'location',
        'prof_pic',
        'status',
        'balance'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'guestID');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'guestID');
    }
}
