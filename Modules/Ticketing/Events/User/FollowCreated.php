<?php

namespace Modules\Ticketing\Events\User;

use Illuminate\Queue\SerializesModels;
use Modules\Ticketing\Entities\Message;
use Modules\User\Entities\User;

class FollowCreated
{
    use SerializesModels;

    /**
     * Ticket variable
     */
    public $ticket;

    /**
     * User variable
     */
    public $user;

    /**
     * reply message variable
     */
    public $message;

    /**
     * Create a new event instance of follow up.
     *
     * @return void
     */
    public function __construct(Message $message, User $user)
    {
         $this->user = $user;
         $this->message = $message;
    }
}
