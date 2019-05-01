<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadCastPurchaseReward extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * public variables accessible in the view template
     * 
     */
    public $customers;
    public $ordermstr;
    public $totalpoints;
    public $actions;
  


    /**
     * Create a new message instance.
     *
     * @return void
     */
    //customers = null to support bcc mail. one time email sending
    public function __construct($customers, $ordermstr, $totalpoints, $actions)
    {
        //
        $this->customers = $customers;
        $this->ordermstr = $ordermstr;
        $this->totalpoints = $totalpoints;
        $this->actions = $actions;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('Reward Points!')
            ->view('landingpage.myaccount.rewards-own-purchase-template');
    }


}
