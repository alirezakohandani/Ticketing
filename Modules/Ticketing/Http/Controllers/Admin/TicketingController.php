<?php

namespace Modules\Ticketing\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticketing\Services\Ticket\Admin\Ticket;

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
}
