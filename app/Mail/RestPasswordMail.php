<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $uu_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uu_id = null)
    {
        $email_setting = widgets('email_setting');

        $this->uu_id = $uu_id;
        $this->subject('Reset Password');
        $this->replyTo($email_setting->contents['from_address'], 'Reset Password');
        $this->from($email_setting->contents['from_address'], 'Reset Password');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('reset_password', ['uuid' => $this->uu_id]);
    }

}
