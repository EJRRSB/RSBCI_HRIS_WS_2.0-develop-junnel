<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailReceipt extends Mailable
{
    use Queueable, SerializesModels;

    const EMAIL_SUBJECT_TEXT = 'Array | Email Receipt';

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$this->bcc(["sdt@rsb-consulting.com"]);
        return $this->subject(self::EMAIL_SUBJECT_TEXT)->markdown('mail.email-receipt', $this->data);
    }
}
