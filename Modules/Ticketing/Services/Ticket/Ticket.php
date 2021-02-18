<?php

namespace Modules\Ticketing\Services\Ticket;

use Illuminate\Http\Request;
use Modules\Ticketing\Entities\Ticket as EntitiesTicket;

class Ticket
{

    /**
     * Store Ticket
     *
     * @param Request $request
     * @return ref_number
     */
    public function store(Request $request)
    {
            $ticket = EntitiesTicket::create([
                'user_id' => 1,
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
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
    }

}