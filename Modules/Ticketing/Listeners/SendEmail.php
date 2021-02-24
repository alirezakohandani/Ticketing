<?php

namespace Modules\Ticketing\Listeners;

use Modules\Ticketing\Events\TicketCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Ticketing\Emails\TicketMail;
use Modules\Ticketing\Services\Notification\Email;

class SendEmail
{

    /**
     * Handle the event.
     *
     * @param TicketCreated $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        $email = new Email($event, 'TicketMail');
        $email->send();
    }
}
