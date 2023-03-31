<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

     public $details;
     public $inv;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$inv)
    {
        //
      $this->details = $details; 
      $this->inv = $inv; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('emails.mail');
        return $this->subject('Invoice '.$this->inv)->view('emails.paid');

    }
}
