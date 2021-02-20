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
    protected $signature = 'ticket:create {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create as many tickets as you want';

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
        $number = $this->argument('number');
        for ($i=0; $i <= $number ; $i++) { 
           $this->createFakeTicket();
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
        $users = User::orderBy('id')->get('id')->toArray();
        $id = [];
        foreach($users as $user)
        {
            array_push($id, $user['id']);
        }
        $type = ['immediate', 'normal', 'nonsignificant'];
        $status = ['pending', 'anwserd', 'finished'];
        return Ticket::create([
            'user_id' => $id[array_rand($id)],
            'ref_number' => rand(100000, 999999),
            'type' => $type[array_rand($type)],
            'status' => $status[array_rand($status)],
        ]);
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
