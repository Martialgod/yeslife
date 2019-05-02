<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\BroadCastNewOrders',
        'App\Console\Commands\BroadCastAbandonedCart',
        'App\Console\Commands\BroadCastRecurringOrders',
        'App\Console\Commands\DBEventInsertRecurringOrders', 
        'App\Console\Commands\DBEventInsertOwnPurchaseRewards', 
        'App\Console\Commands\DBEventInsertReferralPurchaseRewards', 
        'App\Console\Commands\DBEventInsertReferralSignupRewards', 
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Daily Jobs At A Specific Time (24 Hour Time)
        //$schedule->command('foo')->dailyAt('15:00');
        
        $schedule->command('dbevent:insertrecurringorders')->dailyAt('00:05')->withoutOverlapping();
        
        //inserted directly upon checkout
        $schedule->command('dbevent:insertownpurchaserewards')->dailyAt('01:00')->withoutOverlapping();
        
        $schedule->command('dbevent:insertreferralpurchaserewards')->dailyAt('2:00')->withoutOverlapping();

        $schedule->command('dbevent:insertreferralsignuprewards')->dailyAt('03:00')->withoutOverlapping();
        
        //disabled @March 28 2019
        //broadcast is done in the homepage via toastr popup
        //$schedule->command('broadcast:neworders')->dailyAt('02:00')->withoutOverlapping();
        
        $schedule->command('broadcast:abandonedcart')->dailyAt('04:00')->withoutOverlapping();
        
        $schedule->command('broadcast:recurringorders')->dailyAt('05:00')->withoutOverlapping();
      
        //$schedule->command('broadcast:neworders')->everyMinute()->withoutOverlapping();
        //$schedule->command('broadcast:abandonedcart')->everyMinute()->withoutOverlapping();
        
        
        /*$schedule->command('dbevent:insertownpurchaserewards')->everyMinute()->withoutOverlapping();
        $schedule->command('dbevent:insertreferralpurchaserewards')->everyMinute()->withoutOverlapping();
        $schedule->command('dbevent:insertreferralsignuprewards')->everyMinute()->withoutOverlapping();*/

        $schedule->command('queue:work --tries=3')->everyMinute()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
