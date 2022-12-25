<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetWebPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $pinCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pinCode)
    {
        $this->pinCode = $pinCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.reset_web_password',[[ 'pinCode' => $this->pinCode ]]);
    }
}
