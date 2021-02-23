<?php

namespace Modules\Ticketing\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Ticketing\Entities\Ticket;
class TicketFinished
{
    use SerializesModels;

    /**
     * ticket variable
     */
    public $ticket;

    /**
     * Create a new ticket finishedevent instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

}
