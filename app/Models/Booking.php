<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'resorts_admin_bookings';
    // protected $primaryKey = 'id';
    // Specify which attributes can be mass-assigned

    protected $fillable = [
        'guestID',
        'resortID',
        'roomID',
        'payment_method',
        'start_date',
        'end_date',
        'sub-total',
        'total_amount',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'roomID', 'roomID')
            ->where('resortID', $this->resortID);
    }
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guestID');
    }
    public function resort()
    {
        return $this->belongsTo(Resort::class, 'resortID');
    }
}
