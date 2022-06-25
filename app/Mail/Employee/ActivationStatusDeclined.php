<?php

namespace App\Mail\Employee;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationStatusDeclined extends Mailable
{
    use Queueable, SerializesModels;

    const EMAIL_SUBJECT_TEXT = 'Array | Activation Status - Declined';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        config('app.aliases');
        return $this->subject(self::EMAIL_SUBJECT_TEXT)->markdown('mail.Employee.activation-status-declined');
    }
}
