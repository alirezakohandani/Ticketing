<?php

namespace Modules\Ticketing\Listeners\User;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ticketing\Events\User\FollowCreated;

class TicketChangeStatus
{
    /**
     * Change ticket status.
     *
     * @param FollowCreated $event
     * @return void
     */
    public function handle(FollowCreated $event)
    {
        $event->message->ticket->followed(); 
    }
}
