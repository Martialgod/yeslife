<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB; //responsible for DB

use App\OrderMstr;

use Mail;
use Log;

use Carbon\Carbon;

//can be done in mysql event but only if the user has root access

class DBEventInsertRecurringOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbevent:insertrecurringorders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert new recurring orders in the database every 12:05am';

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
        
        Log::info("Request cycle DBEventInsertRecurringOrders started");

        //retrieve orders for approval or recurring orders
        OrderMstr::insertRecurringOrders();

        Log::info("Request cycle DBEventInsertRecurringOrders finished");
    
    }


}//END class
