<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactUs;

    public function __construct($contactUs)
    {
        $this->contactUs = $contactUs;
    }

    public function build()
    {
        return $this->markdown('emails.accept')
                    ->with([
                        'contactUs' => $this->contactUs,
                    ]);
    }
}
