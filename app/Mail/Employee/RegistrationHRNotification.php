<?php

namespace App\Mail\Employee;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationHRNotification extends Mailable
{
    use Queueable, SerializesModels;

    const EMAIL_SUBJECT_TEXT = 'Array | New Registered Employee - ';

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
        return $this->subject(self::EMAIL_SUBJECT_TEXT . $this->data['first_name'] . ' ' . $this->data['last_name'])->markdown('mail.Employee.registration-HR-notification', $this->data);
    }
}
