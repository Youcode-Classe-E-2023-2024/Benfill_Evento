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
        'event_location',
        'category_id',
        'places',
        'price',
        'organizer',
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

    function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}
