<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Wnx\SidecarBrowsershot\BrowsershotLambda;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::where('reservation_id', $id)->get()->first();
        $event = Event::find($ticket->event_id);
        return view('pages.front_office.thankYouPage', [
            'status' => 'Congratulations! Your reservation for Evento is confirmed! 🥳 Your e-ticket is ready for download below. Thank you for choosing to be a part of this special event. We look forward to seeing you there!',
            'qr' => false,
            'event' => $event,
            'ticket' => $ticket
        ]);
    }


    function downloadTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticketId);
        $event = Event::find($ticket->event_id);

        BrowsershotLambda::url(url("/ticket/download/$request->ticketId"))->save('ticket.pdf');
    }

    function getTicketPage($id)
    {
        $ticket = Ticket::find($id);
        $event = Event::find($ticket->event_id);
        return view('ticket', [
            'qr' => false,
            'ticket' => $ticket,
            'event' => $event
        ]);
    }
}
