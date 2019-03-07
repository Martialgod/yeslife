<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\OrderRecurringMstrView;

class BroadCastRecurringOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:recurringorders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert recurring orders to database and send email to all users for approval';

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

        OrderRecurringMstrView::automateBroadCastRecurringOrders();
        
        //displayed in the command line
        $this->info('Request cycle BroadCastNewOrders Ended....');


    }//END handle

}//END class
