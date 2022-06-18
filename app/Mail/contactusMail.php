<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($req)
    {
        //
        $this->data = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('NGATA HOMES - CONTACT US')->view('emails.contactusMailer');
    }
}

