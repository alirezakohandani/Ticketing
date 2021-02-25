<?php

namespace Modules\Ticketing\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticketing\Entities\Ticket;
use Modules\Ticketing\Events\ReplyCreated;
use Modules\Ticketing\Transformers\Admin\Errors\TicketResource;
use Modules\Ticketing\Transformers\Admin\Reply\ReplyResource;

class ReplyController extends Controller
{

    /**
     * Set auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a message for a specific ticket
     * @param Request $request
     * @return json
     */
    public function store(Ticket $ticket,Request $request)
    {
        if (!\Gate::any(['response tickets', 'super_admin'])) 
        {
            return response()->json(new TicketResource(auth()->user()));
        }
        $message = $this->createMessage($ticket, $request);
        event(new ReplyCreated($message, auth()->user()));
        return response()->json(new ReplyResource($message));
    }

    /**
     * Create message
     *
     * @param Ticket $ticket
     * @param Request $request
     * @return Modules\Ticketing\Entities\Message
     */
    private function createMessage(Ticket $ticket, Request $request)
    {
        return $ticket->messages()->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }

    
}
