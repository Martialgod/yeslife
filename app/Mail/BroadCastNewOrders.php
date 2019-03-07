<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadCastNewOrders extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * public variables accessible in the view template
     * 
     */
    
    public $ordermstr;
    public $orderdtls;
    public $customers;
  


    /**
     * Create a new message instance.
     *
     * @return void
     */
    //customers = null to support bcc mail. one time email sending
    public function __construct($ordermstr, $orderdtls, $customers = null)
    {
        //
        $this->ordermstr = $ordermstr;
        $this->orderdtls = $orderdtls;
        $this->customers = $customers;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('New Orders!')
            ->view('admin.orders.broadcast-template');
    }
}
