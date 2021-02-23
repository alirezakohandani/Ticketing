<?php

namespace Modules\Ticketing\Listeners;

use Modules\Ticketing\Events\ReplyCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ticketChangeStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ReplyCreated $event
     * @return void
     */
    public function handle(ReplyCreated $event)
    {
        if ($event->user->hasPermission('response tickets')) 
        {
          $event->message->ticket->replied();  
        }
    }
}
