<?php

namespace Modules\Ticketing\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ticketing\Entities\Ticket;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Ticket variable
     */
    private $ticket;

    /**
     * Create a new ticket email instance.
     *
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ref_number = $this->ticket->ref_number;
        $title = $this->ticket->messages()->first()->title;
        return $this->view('ticketing::mail.TicketMail', compact('ref_number', 'title'));
    }
}
