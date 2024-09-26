<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReportsEmailToUser extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $scv;

    public function __construct($scv)
    {
        $this->scv = $scv;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.send-email-reports-to-user', [
            'scv' => $this->scv,
        ]);
    }
}
