<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSubsConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * public variables accessible in the view template
     * 
     */
    
    public $users;
  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        //
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
            ->subject('Activate Subscription!')
            ->view('landingpage.layouts.subscription-email-template');
   
    }

}//END class
