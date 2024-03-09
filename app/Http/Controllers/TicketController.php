<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $pdf = Pdf::loadView('components.ticket', [
            'qr' => $ticket->qr_code,
            'ticket' => $ticket,
            'event' => $event
        ]);
        return $pdf->download('Evento_ticket.pdf');
    }
}
