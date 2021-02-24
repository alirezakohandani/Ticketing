<?php

namespace Modules\Ticketing\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
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
     * Execute the job (send email).
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->event->user->email)->send(new $this->mailable($this->event->ticket));
    }
}
