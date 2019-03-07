<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\OrderBroadcast;


class BroadCastNewOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:neworders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email to all users when someone purchase new orders';

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
        //
        
        //displayed in the command line
        $this->info('Request cycle BroadCastNewOrders Started...');

        OrderBroadcast::automateBroadCastNewOrders();
        
        //displayed in the command line
        $this->info('Request cycle BroadCastNewOrders Ended....');


    }//END handle

}//END class
