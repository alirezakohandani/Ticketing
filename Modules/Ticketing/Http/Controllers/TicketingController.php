<?php

namespace Modules\Ticketing\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;
use Modules\Ticketing\Services\Ticket\Ticket;
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
        $tickets = EntitiesTicket::where('user_id', $user->id)->get();
        return response()->json(new TicketIndexCollection($tickets));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       $ref_number = $this->ticket->store($request);
       return response()->json([
        'ref_number' => $ref_number,
        'status' => 200,
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
