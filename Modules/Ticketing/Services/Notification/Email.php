<?php

namespace Modules\Ticketing\Services\Notification;

use Illuminate\Support\Facades\Mail;
use Modules\Ticketing\Jobs\SendEmail;
use Modules\Ticketing\Services\Notification\Contract\Notification;

class Email implements Notification
{

    /**
     * event variable
     */
    private $event;

    /**
     * mailable variable
     */
    private $mailable;

    /**
     * Set event and email type
     *
     * @param $event
     * @param $mailable
     */
    public function __construct($event, $mailable)
    {
        $this->event = $event;
        $this->mailable = $mailable;
        
    }
    /**
     * Send email according to the type of email specified in mailable
     *
     * @return void
     */
    public function send()
    {
        $mailable = 'Modules\Ticketing\Emails\\' . $this->mailable;
        SendEmail::dispatch($this->event, $mailable);
    }
}