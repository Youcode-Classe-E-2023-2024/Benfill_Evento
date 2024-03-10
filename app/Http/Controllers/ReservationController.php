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
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Organizer')) {
            $events = Event::where('user_id', $user->id)->get();

            if (count($events) !== 0) {
                $eventIds = $events->pluck('id')->toArray();
                $reservations = Reservation::whereIn('event_id', $eventIds)->paginate(5, ['*'], 'reservations');
                $reservationsRequest = Reservation::whereIn('event_id', $eventIds)
                    ->where('status', 'unconfirmed')
                    ->paginate(5, ['*'], 'reservations');
            } else {
                $reservations = collect();
                $reservationsRequest = collect();
            }
        } else {
            $reservations = Reservation::paginate(5, ['*'], 'reservations');

            $reservationsRequest = Reservation::where('status', 'unconfirmed')
                ->paginate(5, ['*'], 'reservations');
        }

        return view('pages.back_office.reservations', compact('reservations', 'reservationsRequest'));
    }


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
            $event->places--;
            $event->save();

            Mail::to(Auth::getUser()->email)
                ->send(new \App\Mail\ticket($ticket->id));
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

    function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id()
        )->paginate(9);
        return view('pages.front_office.myReservations', compact('reservations'));
    }

    function destroy($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = "canceled";
        $reservation->save();

        return back();
    }

    function changeStatus(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (isset($request->accept)) {
            $reservation->update(['status' => "confirmed"]);
            $ticket = Ticket::create([
                'event_id' => $request->eventId,
                'user_id' => Auth::id(),
                'reservation_id' => $reservation->id
            ]);
            $event = Event::find($request->eventId);
            $ticket->qr_code = QrCode::generate($event->title);
            $ticket->save();
            $event->places--;
            $event->save();

            Mail::to(Auth::getUser()->email);
        } else {
            to_route('reservations.destroy', $id);
        }
        return back();
    }
}
