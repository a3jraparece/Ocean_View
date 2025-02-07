<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;


class Resort extends Model
{
    use HasFactory;

    // Define the table name if it's not the default "resorts"
    protected $table = 'resorts_admin';
    protected $primaryKey = 'resortID';
    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'resort_name',
        'username',
        'password',
        'location',
        'location_coordinates',
        'floorCount',
        'roomPerFloor',
        'taxRate',
        'room_rate',
        'status',
        'contactDetails',
        'mainImage',
        'image1',
        'image1_2',
        'image1_3',
        'image2',
        'image3',
        'resort_description',
        'amenities',
        'room_image_1',
        'room_image_2',
        'room_image_3',
        'room_description'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'resortID', 'id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'resortID');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'resortID');
    }
}
