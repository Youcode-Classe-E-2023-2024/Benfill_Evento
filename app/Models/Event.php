<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'picture',
        'location_id',
        'category_id',
        'reservationCount',
        'places',
        'price',
        'user_id',
        'status',
        'date',
        'slug'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }
    function category() {
        return $this->belongsTo(Category::class);
    }

    function location() {
        return $this->belongsTo(Location::class);
    }

    function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
