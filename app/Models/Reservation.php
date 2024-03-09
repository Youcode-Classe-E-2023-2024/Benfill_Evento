<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
      'event_id',
      'user_id',
      'status'
    ];

    function event() {
        return $this->belongsTo(Event::class);
    }

    function ticket() {
        return $this->hasMany(Event::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
