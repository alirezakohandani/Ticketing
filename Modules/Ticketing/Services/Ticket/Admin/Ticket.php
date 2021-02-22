<?php

namespace Modules\Ticketing\Services\Ticket\Admin;

use Illuminate\Http\Request;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Transformers\Admin\TicketIndexCollection;
use Modules\Ticketing\Transformers\Front\MessageShowResource;

class Ticket
{
    /**
     * Ability to view the list of tickets by authorized admins
     *
     * @return json
     */
    public function index()
    {
        if (\Gate::allows('see tickets')) {
            $tickets = $this->ticketWithPendingStatus();
            return response()->json(new TicketIndexCollection($tickets));
        }
    }

    /**
     * Tickets whose status is pending
     *
     * @return collection
     */
    private function ticketWithPendingStatus()
    {
        return EntitiesTicket::where('status', 'pending')->get();
    }
}