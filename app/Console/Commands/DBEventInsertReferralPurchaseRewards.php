<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB; //responsible for DB

use App\UserReward;

use Mail;
use Log;

use Carbon\Carbon;


class DBEventInsertReferralPurchaseRewards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbevent:insertreferralpurchaserewards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert referral purchase rewards in the database around midnight';

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
        Log::info("Request cycle DBEventInsertReferralPurchaseRewards started");

        UserReward::insertReferralPurchaseRewards();

        Log::info("Request cycle DBEventInsertReferralPurchaseRewards finished");
    }

}//END class
