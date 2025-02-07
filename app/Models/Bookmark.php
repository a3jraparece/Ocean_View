<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'guest_bookmarks';
    protected $fillable = ['guestID', 'resortID'];

    public function user()
    {
        return $this->belongsTo(Guest::class, 'guestID');
    }

    public function resort()
    {
        return $this->belongsTo(Resort::class, 'resortID');
    }
}
