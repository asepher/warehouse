<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $vsl;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$vsl)
    {
        // 
        $this->details = $details;
        $this->vsl = $vsl;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        //return $this->markdown('emails.mail');
        return $this->subject('Upload success : '.$this->vsl)->view('emails.upload');
    }
}
