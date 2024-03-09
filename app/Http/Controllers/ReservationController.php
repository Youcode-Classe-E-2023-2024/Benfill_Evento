<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    function create($slug)
    {
        $event = Event::where('slug', $slug)->get()->first();
        return view('pages.front_office.orderConfirmation', [
            'event' => $event
        ]);
    }

    function store(Request $request)
    {

        $eventId = $request->eventID;
        $event = Event::find($eventId);
        $event->reservationCount++;
        $event->save();

        $reservation = Reservation::create([
            'event_id' => $eventId,
            'user_id' => Auth::id(),
        ]);

        if ($event->validation === 'auto') {
            $ticket = Ticket::create([
                'event_id' => $eventId,
                'user_id' => Auth::id(),
                'reservation_id' => $reservation->id
            ]);
            $ticket->qr_code = QrCode::generate($event->title);
            $ticket->save();

                /*Mail::to()
                    ->send( );*/
            return view('pages.front_office.thankYouPage', [
                'status' => 'Congratulations! Your reservation for Evento is confirmed! 🥳 Your e-ticket is ready for download below. Thank you for choosing to be a part of this special event. We look forward to seeing you there!',
                'qr' => $ticket->qr_code,
                'event' => $event,
                'ticket' => $ticket
            ]);
        }
        return view('pages.front_office.thankYouPage', [
            'status' =>
                'Thank you for reserving your spot at Evento! Your registration is being processed and validated by our organizers. You will receive an email with your event ticket once the validation is complete. Get ready for an unforgettable experience! 🎉
']);
    }
}
