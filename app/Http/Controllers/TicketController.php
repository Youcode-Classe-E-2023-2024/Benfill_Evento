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
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
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
