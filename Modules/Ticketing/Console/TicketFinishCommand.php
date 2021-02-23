<?php

namespace Modules\Ticketing\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Modules\Ticketing\Entities\Ticket;

class TicketFinishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tickets left unanswered by users will be closed.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tickets = Ticket::Where('created_at', '<', 
                                Carbon::now()->subDay())
                                             ->where('status', 'awserd')
                                             ->get();
        foreach($tickets as $ticket)
        {
            $ticket->finishedStatus();
        }                                  
    }

}
