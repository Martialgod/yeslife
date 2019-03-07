<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * public variables accessible in the view template
     * 
     */
    
    public $ordermstr;
    public $orderdtls;
    public $users;
  


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ordermstr, $orderdtls, $users)
    {
        //
        $this->ordermstr = $ordermstr;
        $this->orderdtls = $orderdtls;
        $this->users = $users;  
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
            ->view('landingpage.success-email-template');
    }
}
