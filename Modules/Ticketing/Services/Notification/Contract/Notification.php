<?php

namespace Modules\Ticketing\Services\Notification\Contract;

interface Notification
{
    /**
     * Send notification
     */
    public function send();
}