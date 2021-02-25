<?php

namespace Modules\Ticketing\Console;

use Illuminate\Console\Command;
use Modules\Ticketing\Entities\Ticket;
use Modules\User\Entities\User;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:create {numberOfTicket} {numberOfMessage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create as many tickets as you want';

    /**
     * User variable
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Create tickets and messages for tickets
     *
     * @return mixed
     */
    public function handle()
    {
        $numberOfTicket = $this->argument('numberOfTicket');
        $numberOfMessage = $this->argument('numberOfMessage');
        for ($i=0; $i < $numberOfTicket ; $i++) { 
           $ticket = $this->createFakeTicket();
             for ($j=0; $j < $numberOfMessage ; $j++) { 
                $this->createFakeMessage($ticket, $j);
            }
        }
    }
    
    /**
     * Create Fake Ticket
     *
     * @param [arrya] $id
     * @param [array] $type
     * @param [array] $status
     * @return Modules\Ticketing\Entities\Ticket
     */
    private function createFakeTicket()
    {
        $ids = $this->usersIds();
        $type = ['immediate', 'normal', 'nonsignificant'];
        $status = ['pending', 'anwserd', 'finished'];
        return Ticket::create([
            'user_id' => $ids[array_rand($ids)],
            'ref_number' => rand(100000, 999999),
            'type' => $type[array_rand($type)],
            'status' => $status[array_rand($status)],
        ]);
    }

    /**
     * Create a fake message for each ticket
     *
     * @param Ticket $ticket
     * @param int $j // Counter
     * @return Modules\Ticketing\Entities\Ticket
     */
    private function createFakeMessage(Ticket $ticket,int $j)
    {
        $ids = $this->usersIds();
        $ticket->messages()->create([
            'ticket_id' => $ticket->ids,
            'user_id' => $j === 0 ? $ticket->user_id : $ids[array_rand($ids)],
            'title' => 'title' . $j,
            'description' => 'description'. $j,
        ]);
    }

    /**
     * Returns all user ids
     *
     * @return array
     */
    private function usersIds()
    {
        $users_id = $this->user->getAllUsers();
        $ids = [];
        foreach($users_id as $id)
        {
            array_push($ids, $id->id);
        }
        return $ids;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
