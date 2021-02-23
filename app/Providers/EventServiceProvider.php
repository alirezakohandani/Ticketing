<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Ticketing\Events\ReplyCreated;
use Modules\Ticketing\Events\TicketCreated;
use Modules\Ticketing\Events\TicketFinished;
use Modules\Ticketing\Listeners\SendEmail;
use Modules\Ticketing\Listeners\ticketChangeStatus;
use Modules\Ticketing\Listeners\ticketFinishedStatus;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TicketCreated::class => [
            SendEmail::class,
        ],
        ReplyCreated::class => [
            ticketChangeStatus::class,
        ],
        TicketFinished::class => [
            ticketFinishedStatus::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
