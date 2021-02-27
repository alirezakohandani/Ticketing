<?php

namespace Modules\Ticketing\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Ticketing\Entities\Ticket;
use Modules\Ticketing\Events\ReplyCreated;
use Modules\Ticketing\Transformers\Admin\Errors\TicketResource;
use Modules\Ticketing\Transformers\Admin\Reply\ReplyResource;
use Modules\Ticketing\Transformers\Errors\ValidationErrorResource;

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
        $validator = $this->validateForm($request);
        if (!$validator->fails()) {
            $message = $this->createMessage($ticket, $request);
            event(new ReplyCreated($message, auth()->user()));
            return response()->json(new ReplyResource($message));
        }
        return response()->json(new ValidationErrorResource($validator->errors()->first()));    
    }

    /**
     * validation to respond to tickets
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => ['required', 'max:255'],
           'description' => ['required'],
        ]);
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
