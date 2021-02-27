<?php

namespace Modules\Ticketing\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Events\TicketFinished;
use Modules\Ticketing\Rules\Status;
use Modules\Ticketing\Rules\type;
use Modules\Ticketing\Services\Ticket\Admin\Ticket;
use Modules\Ticketing\Transformers\Admin\TicketFinishResource;
use Modules\Ticketing\Transformers\Errors\ValidationErrorResource;

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
        $validator = Validator::make($request->all(), [
            'ref_number' => ['required', 'integer', 'exists:tickets'],
            'type' => ['required', 'string', new type($request)],
        ]);
        if (!$validator->fails()) {
            return $this->ticket->update($request);
        }
            return response()->json(new ValidationErrorResource($validator->errors()->first())); 
    }

    /**
     * Close ticket
     *
     * @param EntitiesTicket $ticket
     * @return json
     */
    public function close(EntitiesTicket $ticket, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'string', new Status($request)],
        ]);
        if (!$validator->fails()) {
            event(new TicketFinished($ticket));
            return response()->json(new TicketFinishResource($ticket));
        }
            return response()->json(new ValidationErrorResource($validator->errors()->first()));
    }

}
