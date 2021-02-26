<?php

namespace Modules\Ticketing\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Rules\type;
use Modules\Ticketing\Services\Ticket\Ticket;
use Modules\Ticketing\Transformers\Errors\ValidationErrorResource;
use Modules\Ticketing\Transformers\Front\TicketStoreResource;
use Modules\Ticketing\Transformers\Front\TicketIndexCollection;

class TicketingController extends Controller
{

    private $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }
    /**
     * Display a listing of the tickets for logged in users.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $tickets = EntitiesTicket::where('user_id', $user->id)->paginate(10);
        return response()->json(new TicketIndexCollection($tickets));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = $this->validateForm($request);
        if (!$validator->fails()) 
        {
            $ticket = $this->ticket->store($request);
            return response()->json(new TicketStoreResource($ticket));
        }
        return response()->json(new ValidationErrorResource($validator->errors()->first()));
    }

    /**
     * validation for registration and ticket registration
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        return Validator::make($request->all(), [
           'email' => ['required', 'email', 'unique:users'],
           'type' => ['required', 'string', new type($request)],
           'title' => ['required', 'max:255'],
           'description' => ['required'],
    ]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(EntitiesTicket $ticket)
    {
        return $this->ticket->show($ticket);
    }
  
}
