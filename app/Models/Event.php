<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'resorts_admin_events';

    protected $fillable = [
        'start_date',
        'name',
        'end_date'
    ];
}
