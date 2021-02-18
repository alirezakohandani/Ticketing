<?php

namespace Modules\Ticketing\Services\Ticket;

use Illuminate\Http\Request;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;

class Ticket
{
    /**
     * Ticket variable
     *
     * @var [type]
     */
    private $ticket;

    /**
     * Set ticket
     *
     * @param EntitiesTicket $ticket
     */
    public function __construct(EntitiesTicket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Store Ticket
     *
     * @param Request $request
     * @return ref_number
     */
    public function store(Request $request)
    {
            $id = $this->ticket->register($request->email); 
            $ticket = EntitiesTicket::create([
                'user_id' => $id,
                'ref_number' => 1234,
                'type' => $request->type,
                'status' => 'pending',
            ]);
               
            $this->setMessage($request, $ticket);
            return $ticket->ref_number;
    }

    /**
     * Set the first message by the user for a new ticket 
     *
     * @param Request $request
     * @param EntitiesTicket $ticket
     * @return void
     */
    protected function setMessage(Request $request, EntitiesTicket $ticket)
    {
        $ticket->messages()->create([
            'user_id' => $ticket->user_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
    }

}