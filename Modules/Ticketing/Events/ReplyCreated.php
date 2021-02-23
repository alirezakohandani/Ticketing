<?php

namespace Modules\Ticketing\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Ticketing\Entities\Message;

class ReplyCreated
{
    use SerializesModels;

    /**
     * reply message variable
     */
    public $message;

    /**
     * User variable
     */
    public $user;

    /**
     * Create a new Reply event instance.
     *
     * @return void
     */
    public function __construct(Message $message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }
}
