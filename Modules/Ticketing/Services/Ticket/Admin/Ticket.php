<?php

namespace Modules\Ticketing\Services\Ticket\Admin;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Rules\type;
use Modules\Ticketing\Transformers\Admin\Errors\TicketResource;
use Modules\Ticketing\Transformers\Admin\TicketIndexCollection;
use Modules\Ticketing\Transformers\TicketUpdateResource;

class Ticket
{
    /**
     * Ability to view the list of tickets by authorized admins
     *
     * @return json
     */
    public function index()
    {
        if (!Gate::any(['see tickets', 'finished tickets', 'super_admin']))
        {
            return response()->json(new TicketResource(auth()->user())); 
        }
        $tickets = $this->ticketWithPendingStatus();
        return response()->json(new TicketIndexCollection($tickets));
    }

    /**
     * Tickets whose status is pending
     *
     * @return collection
     */
    private function ticketWithPendingStatus()
    {
        return EntitiesTicket::where('status', 'pending')->paginate(10);
    }

    /**
     * Changes the ticket status and check Access level
     *
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {
        if (!Gate::any(['response tickets', 'super_admin'])) 
        {
            return response()->json(new TicketResource(auth()->user()));
        }
        $this->validation($request);
        $ticket = $this->getTicket($request->ref_number); 
        $ticket = $ticket->update([
            'type' => $request->type,
        ]);
        return response()->json(new TicketUpdateResource($ticket));
    }

    /**
     * Request Validation
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'ref_number' => ['required:api', 'integer:api'],
            'type' => ['required:api', 'string:api', new type($request)],
        ]);
    }
    /**
     * Returns specific ticket based on ref_number
     *
     * @param [int] $ref_number
     * @return Modules\Ticketing\Entities\Ticket
     */
    private function getTicket($ref_number)
    {
        return EntitiesTicket::where('ref_number', $ref_number);
    }
}