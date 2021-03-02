<?php

namespace Modules\Ticketing\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Ticketing\Entities\Ticket;
use Modules\User\Entities\User;

class TicketCreated
{
    use SerializesModels;

    /**
     * Ticket variable
     */
    public $ticket;

    /**
     * User variable
     */
    public $user;

    /**
     * Mailable variable
     */
    public $mailable = 'TicketMail';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket, User $user)
    {
        $this->ticket = $ticket;
        $this->user = $user;
    }

}
