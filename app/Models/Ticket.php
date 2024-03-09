<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'user_id',
        'reservation_id',
        'qr_code'
    ];

    function event() {
        return $this->belongsTo(Event::class);
    }

    function reservation() {
        return $this->belongsTo(Reservation::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
