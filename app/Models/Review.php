<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";

    protected $primaryKey = 'reviewID';

    protected $fillable = [
        'reviewID',
        'guestID',
        'resortID',
        'rating',
        'comment',
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guestID');
    }
}
