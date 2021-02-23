<?php

namespace Modules\Ticketing\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Events\TicketFinished;
use Modules\Ticketing\Services\Ticket\Admin\Ticket;
use Modules\Ticketing\Transformers\Admin\TicketFinishResource;

class TicketingController extends Controller
{
    private $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->middleware('auth:api');
        $this->ticket = $ticket;
    }
    /**
     * Display a listing of the tickets by authorized admins.
     * @return json
     */
    public function index()
    {
       return $this->ticket->index();
    }

    /**
     * Changes the ticket status
     *
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {
        return $this->ticket->update($request);
    }

    /**
     * Close ticket
     *
     * @param EntitiesTicket $ticket
     * @return json
     */
    public function close(EntitiesTicket $ticket)
    {
        event(new TicketFinished($ticket));
        return response()->json(new TicketFinishResource($ticket));
    }
}
