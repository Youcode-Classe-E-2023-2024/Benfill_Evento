<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    function store(Request $request)
    {
        $eventId = $request->eventId;
        $event = Event::find($eventId);
        $event->reservationCount .= 1;
        $event->save();
    }
}
