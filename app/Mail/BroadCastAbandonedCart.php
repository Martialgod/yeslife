<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadCastAbandonedCart extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * public variables accessible in the view template
     * 
     */
    
    public $customers;
    public $abandonedcart;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    //customers and abandonedcart = null to support bcc mail. one time email sending
    public function __construct($customers = null, $abandonedcart = null)
    {
        //
        $this->customers = $customers;
        $this->abandonedcart = $abandonedcart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->subject('Abandoned Cart!')
            ->view('admin.orders.abandoned-cart-template');
    }
}
