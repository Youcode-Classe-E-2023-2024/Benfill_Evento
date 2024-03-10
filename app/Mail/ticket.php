<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ticket extends Mailable
{
    use Queueable, SerializesModels;

    protected $ticketId;

    /**
     * Create a new message instance.
     */
    public function __construct($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CONGRATS! Evento Ticket',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $ticket = \App\Models\Ticket::find($this->ticketId);
        $event = Event::find($ticket->event_id);
        return new Content(
            view: 'ticket',
            with: [
                'qr' => false,
                'ticket' => $ticket,
                'event' => $event
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
