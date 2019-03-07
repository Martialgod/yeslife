<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\UserAbandonedCartMstrView;



class BroadCastAbandonedCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast:abandonedcart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email to all users who has an abandoned cart';

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
        $this->info('Request cycle BroadCastAbandonedCart Started...');

        UserAbandonedCartMstrView::automateBroadCastAbandonedCart();
        
        //displayed in the command line
        $this->info('Request cycle BroadCastAbandonedCart Ended....');


    }//END handle


}//END class
